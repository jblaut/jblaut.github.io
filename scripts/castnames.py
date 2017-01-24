# -*- coding: utf-8 -*-

import json
import urllib2
from urllib2 import urlopen
from bs4 import BeautifulSoup

theurl = raw_input("Please enter link here:\ne.g. https://en.wikipedia.org/wiki/Ghostbusters_(2016_film) or https://en.wikipedia.org/wiki/Person_of_Interest_(TV_series)\n")
thepage = urllib2.urlopen(theurl)
soup = BeautifulSoup(thepage,"html.parser")
title = soup.title.text.replace(" - Wikipedia","")

print title

show = {}
actors = []

starringTag = soup.find("th", text='Starring').parent.find("ul").findAll("li")

for actor in starringTag:
    actors.append(str(actor.text))

show[title] = {
    'cast': actors
}

with open('data.json', 'w') as outfile:
    json.dump(show, outfile)

