import requests
from bs4 import BeautifulSoup
import mysql.connector
import sys
ourdb = mysql.connector.connect(host="localhost", user="root", password="", database="JICRCS")

ourcursor = ourdb.cursor()

k = sys.argv[1]
keywords = k.replace("%", " ")
location = sys.argv[2] #'Pune Maharashtra' #input()

print(location)
def linkedin():
    URL = 'https://in.linkedin.com/jobs/search?keywords=' + keywords + '&location=' + location + '&position=1&pageNum=0'
    page = requests.get(URL)
    
    soup = BeautifulSoup(page.content, "html.parser")

    pos = []
    loc = []
    com = []
    link = []

    for p in soup.findAll('h3', attrs = {'class':'base-search-card__title'}):
        pos.append(p.get_text().strip())

    for l in soup.findAll('span', attrs = {'class':'job-search-card__location'}):
        loc.append(l.get_text().strip())

    for c in soup.findAll('h4', attrs = {'class':'base-search-card__subtitle'}):
        com.append(c.get_text().strip())

    for a in soup.findAll('a', attrs = {'class':'base-card__full-link'}):
        link.append(a.get('href'))
    
    ran = len(pos)

    for x in range(ran):
        sql = "INSERT INTO jobsdata (position, location, company, link) VALUES ('" + pos[x] + "', '" + loc[x] + "', '" + com[x] + "', '" + link[x] + "');"
        ourcursor.execute(sql)
        ourdb.commit()

def indeed():
    URL = 'https://in.indeed.com/jobs?q=' + keywords + '&l=' + location
    page = requests.get(URL)

    soup = BeautifulSoup(page.content, "html.parser")

    jobs = soup.findAll('td', attrs = {'class':'resultContent'})

    pos = []
    loc = []
    com = []
    link = []

    for p in soup.findAll('h2', attrs = {'class':'jobTitle jobTitle-color-purple'}):
        pos.append(p.get_text().strip())
    
    for l in soup.findAll('div', attrs = {'class':'companyLocation'}):
        loc.append(l.get_text().strip())

    for c in soup.findAll('span', attrs = {'class':'companyName'}):
        com.append(c.get_text().strip())

    for a in soup.findAll('a', attrs = {'class':'tapItem'}):
        link.append("http://www.indeed.com"+a.get('href'))

    ran = len(pos)

    for x in range(ran):
        sql = "INSERT INTO jobsdata (position, location, company, link) VALUES ('" + pos[x] + "', '" + loc[x] + "', '" + com[x] + "', '" + link[x] + "');"
        ourcursor.execute(sql)
        ourdb.commit()

def naukri():    
    key = keywords.replace(" ", "-")
    loc = location.replace(" ", "-")
    newkey = keywords.replace(" ", "%20")
    newloc = location.replace(" ", "%20")
    #URL = 'https://www.naukri.com/' + key + '-jobs-in-' + loc + '?k=' + newkey + '&l=' + newloc
    URL = "https://www.naukri.com/web-development-jobs-in-pune?k=web%20development&l=pune"

    page = requests.get(URL)

    soup = BeautifulSoup(page.content, "html.parser")
    print(soup.prettify())

    jobs = soup.findAll('div', attrs = {'class':'list'})
    for elements in jobs:
        title = elements.find('a', attrs = {'class':'title fw500 ellipsis'})
        print(title.get_text().strip())

def monster():    
    #newkey = keywords.replace(" ", "%20")
    #newloc = location.replace(" ", "%20")
    #URL = 'https://www.monsterindia.com/srp/results?query=' + "%22" + keywords + "%22" + '&locations=' + location
    URL = 'https://www.monsterindia.com/search/web-developer-jobs-in-pune'
    page = requests.get(URL)

    soup = BeautifulSoup(page.content, "html.parser")
    print(soup.prettify())

    jobs = soup.findAll('div', attrs = {'class':'card-apply-content'})
    for elements in jobs:
        title = elements.find('a', attrs = {'class':'job-tittle'})
        print(title.get_text().strip())

def main():
    indeed()
    linkedin()
    

if __name__ == "__main__":
    main()
    
#naukri()
#monster()

ourdb.close()
