import requests
from bs4 import BeautifulSoup
import mysql.connector
import sys
ourdb = mysql.connector.connect(host="localhost", user="root", password="", database="JICRCS")

ourcursor = ourdb.cursor()
k = sys.argv[1]
keywords = sys.argv[1] #input()
location = '' #'Pune Maharashtra' #input()

def edX():
    URL = 'https://www.coursera.org/search?query='+keywords
    page = requests.get(URL)
    soup = BeautifulSoup(page.content, "html.parser")

    name = []
    host = []
    ty = []
    level = []
    link = []

    title=((soup.find('h2', attrs={'class': 'card-title'})).text()).strip()

    for n in soup.findAll('h2', attrs = {'class':'card-title'}):
        name.append(n.get_text().strip().replace("'", "").replace("…", ""))
        print(name)

    for h in soup.findAll('span', attrs = {'class':'partner-name'}):
        host.append(h.get_text().strip().replace("…", ""))

    for t in soup.findAll('span', attrs = {'class':'pillContainer'}):
        ty.append(t.get_text().strip().replace("…", ""))

    # for a in soup.findAll('a', attrs = {'class':'discovery-card-link'}):
    #     link.append(a.get('href'))
    
    ran = len(name)
    print(ran)
    
    for x in range(ran):
        print('s')
        sql = "INSERT INTO courses (name, host, type, link) VALUES ('" + name[x] + "', '" + host[x] + "', '" + ty[x] + "', '" + link[x] + "');"
        ourcursor.execute(sql)
        ourdb.commit()
            
def main():
    edX()

if __name__ == "__main__":
    main()
    
ourdb.close()