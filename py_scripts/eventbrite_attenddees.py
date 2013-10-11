import urllib2
import json
import os

app_key = 'FIRPJUW4JEBU6HESDQ'
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
    for l in lst:
        i = 0
        yaml = ""
        for k,v in l.iteritems():
            v = html_escape(v)
            if '\n' in v:
                v = '|-\n{0}'.format(v)
            elif v == '':
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

def buildlst(attendees):
    lst = []
    for attendee in attendees['attendees']:
        attendee = attendee['attendee']
        fname = attendee['first_name']
        lname = attendee['last_name']
        twitter = ""
        topic = ""
        for answer in attendee['answers']:
            answer = answer['answer']

            if answer['question'] == "Twitter":
                twitter = answer['answer_text']

            if answer['question'] == "Topic of your talk":
                topic = answer['answer_text']

        lst.append({'stamp': '',
                    'first_name': fname,
                    'last_name' : lname,
                    'email': '',
                    'tshirt': '',
                    'twitter': twitter,
                    'topic': topic})
    return lst

def main():
    # get the list of attendees from eventbrite
    print "Getting attendees from Eventbrite ..."
    attendees = getattendees()

    # process the list creating a python list
    print "Processing list ..."
    lst = buildlst(attendees)
    
    # generate the yaml in the format that the barcamproc.org website wants it
    print "Building Yaml ..."
    output_yaml = buildyaml(lst)

    yaml_filename = 'attendees_201311.yml'

    # see if the file exists yet
    if os.path.isfile(yaml_filename):
        # read in the current file, and only update the site if it is different
        with open(yaml_filename) as f:
            last_yaml = f.read()
        if not output_yaml == last_yaml:
            print "Updating Local File with new Attendees ..."
            with open('attendees_201304.yml') as f:
                f.write(output_yaml)
            subprocess.call('./updatesite.sh')
    # ... doesn't exists, just create it
    else:
        print "Writing out Local File with Attendees ..."
        with open('attendees_201304.yml') as f:
            f.write(output_yaml)
        subprocess.call('./updatesite.sh')

    print "Done."

main()
