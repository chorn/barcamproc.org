#!/bin/sh

cp ../data/attendees.yml .
python eventbrite_attenddees.py
mv attendees.yml ../data
cd ..
bundle exec middleman build
