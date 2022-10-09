import requests
from bs4 import BeautifulSoup
import mysql.connector
import sys

ourdb = mysql.connector.connect(host="localhost", user="root", password="", database="JICRCS")

ourcursor = ourdb.cursor()

k = sys.argv[1]
keywords = k.replace("%", " ") #'Web Development' #input()
location = ''
try:
    location = sys.argv[2]#'Pune' #input()
except:
    pass
 
def intershala():
    
    if(not location):
        URL = 'https://internshala.com/internships/' + keywords + '-internship'
    else:
        URL = 'https://internshala.com/internships/' + keywords + '-internship-in-' + location
        
    page = requests.get(URL)

    soup = BeautifulSoup(page.content, "html.parser")

    dom = []
    loc = []
    com = []
    link = []

    for d in soup.findAll('div', attrs = {'class':'heading_4_5 profile'}):
        dom.append(d.get_text().strip())

    for lo in soup.findAll('div', attrs = {'id':'location_names'}):
        loc.append(lo.get_text().strip())

    for c in soup.findAll('div', attrs = {'class':'heading_6 company_name'}):
        com.append(c.get_text().strip())

    ld = soup.findAll('div', attrs = {'class':"heading_4_5 profile"})

    for a in ld:
        ln = a.find('a')
        link.append(ln.get('href'))

    ran = len(dom)

    for x in range(ran):
        sql = "INSERT INTO intsdata (domain, location, company, link) VALUES ('" + dom[x] + "', '" + loc[x] + "', '" + com[x] + "', '" + link[x] + "');"
        ourcursor.execute(sql)
        ourdb.commit()

def main():
    intershala()    

if __name__ == "__main__":
    main()

ourdb.close()