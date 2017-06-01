# -*- coding: utf-8 -*-

import urllib
import urllib.request
from bs4 import BeautifulSoup
import re

saveFile = open("example.txt","a")
theurl = input("Please enter link here:\n")
thepage = urllib.request.urlopen(theurl)
soup = BeautifulSoup(thepage,"html.parser")
title = soup.title.text

saveFile.write(title.replace(" (TV series) - Wikipedia",""))
saveFile.write("\n\n")


starringTag = soup.find("th", text='Starring').parent.find("ul").findAll("li")

for actor in starringTag:
    actorName = actor.text + "\n"
    saveFile.write(actorName)

saveFile.write("\n")
saveFile.write("----")
saveFile.write("\n\n")

saveFile.close()