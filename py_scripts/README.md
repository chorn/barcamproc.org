###wat###

There are two files here.  the python script will pull he attendee list and write out the yam
file if it is different (new attendees added).  the bash script will recompile the site with the new 
yaml file.  the bash script is called from the python script.

put the python script in a cron job for every 5 minutes or so, and you'll be good to go.
