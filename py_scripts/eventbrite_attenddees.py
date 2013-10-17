#!/usr/bin/env python

import urllib2
import json
import os
import re

app_key = '2C4BZOJXZWR5PKDSQV'
event_id = '8645022495'

html_escape_table = {
    "&": "&amp;",
    '"': "&quot;",
    "'": "&apos;",
    ">": "&gt;",
    "<": "&lt;",
    }
 
def html_escape(text):
    """Produce entities within text."""
    return "".join(html_escape_table.get(c,c) for c in text)

def getattendees():
    url = 'https://www.eventbrite.com/json/event_list_attendees/?app_key='
    url += app_key
    url += '&id='
    url += event_id
    response = urllib2.urlopen(url)
    return json.load(response)

def buildyaml(lst):
    coolkidsyaml = ":talks:\n"
    lamekidsyaml = ":deadbeats:\n"
    sameasnothing = ['','n/a','tbd','not sure yet','I will not be presenting',
                     'undecided','none planned yet...','tba']
    for l in lst:
        i = 0
        yaml = ""
        for k,v in l.iteritems():
            v = html_escape(v)
            if '\n' in v:
                v = '|-\n{0}'.format(v)
            elif v.strip().lower() in sameasnothing:
                v = "''"
            if i == 0:
                yaml += "- :{0}: {1}\n".format(k,v)
            else:
                yaml += "  :{0}: {1}\n".format(k,v)
            i += 1

        if "topic: ''" in yaml:
            lamekidsyaml += yaml
        else:
            coolkidsyaml += yaml

    output_yaml = "---\n{0}{1}".format(coolkidsyaml,lamekidsyaml)
    return output_yaml

def _exists(lst,twitter):
    exists = False

    for l in lst:
        if l['twitter'].strip().lower() == twitter.strip().lower():
            exists = True
            break

    return exists

def buildlst(attendees):
    lst = []

    # reverse the list, that way the 'most latest registration is taken
    # rather than the first. (you're welcome BlueLlama)
    stuff = attendees['attendees'][::-1]
  
    for attendee in stuff:
        attendee = attendee['attendee']
        fname = attendee['first_name']
        lname = attendee['last_name']
        twitter = ""
        topic = ""
        for answer in attendee['answers']:
            answer = answer['answer']

            if answer['question'] == "Twitter":
                twitter = answer['answer_text']
                # clean up the handle, remove the @ symbol.  The ruby side of things
                # handles formating for this.
                twitter = re.sub('^.*/', '', twitter.replace('@', ''))

            if answer['question'] == "Topic of your talk":
                topic = answer['answer_text']

        if not _exists(lst,twitter):
            lst.append({'stamp': '',
                        'first_name': fname,
                        'last_name' : lname,
                        'email': '',
                        'tshirt': '',
                        'twitter': twitter,
                        'topic': topic.replace(':', '')})

    
    

    return lst

def main():
    # get the list of attendees from eventbrite
    print "Getting attendees from Eventbrite ..."
    attendees = getattendees()

    # process the list creating a python list
    print "Processing list ..."
    lst = buildlst(attendees)
    
    # save off the created json list (debug)
    #with open('attendees.json', 'w') as f:
    #    f.write(json.dumps(lst))

    # generate the yaml in the format that the barcamproc.org website wants it
    print "Building Yaml ..."
    output_yaml = buildyaml(lst)

    print "Writing out Local File with Attendees ..."
    with open('attendees.yml', 'w') as f:
        f.write(output_yaml)

    print "Done."

main()
