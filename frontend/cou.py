import requests
from bs4 import BeautifulSoup
import mysql.connector
import sys
ourdb = mysql.connector.connect(host="localhost", user="root", password="", database="JICRCS")

ourcursor = ourdb.cursor()
k = sys.argv[1]
keywords = k.replace(' ', '-')
# keywords = sys.argv[1] #'web-development' #input()
location = '' #'Pune Maharashtra' #input()

def edX():
    URL = 'https://www.edx.org/learn/' + keywords
    print(URL)
    page = requests.get(URL)
    soup = BeautifulSoup(page.content, "html.parser")

    # print(URL)    

    name = []
    host = []
    ty = []
    level = []
    link = []

    # try:
    for n in soup.findAll('div', attrs = {'class':'d-card-body'}):
        name.append(n.get_text().strip().replace("'", "").replace("…", ""))


        
    # except:
    #     for n in soup.findAll('h3', attrs = {'class':'text-black'}):
    #         name.append(n.get_text().strip().replace("'", "").replace("…", ""))
    #         print(name)
        
    # print(name)
    # print(len(name))

    for h in soup.findAll('div', attrs = {'class':'provider'}):
        host.append(h.get_text().strip().replace("…", ""))
        
    # print(host)
    # print(len(host))

    for t in soup.findAll('div', attrs = {'class':'d-card-footer'}):
        ty.append(t.get_text().strip().replace("…", ""))

    # print(ty)
    # print(len(ty))

    for a in soup.findAll('a', attrs = {'class':'discovery-card-link'}):
        domain = "https://www.edx.org"
        link.append(domain + a.get('href'))

    # print(link)
    # print(len(link))    
    
    ran = len(name)
    
    for x in range(ran):
        sql = "INSERT INTO courses (name, host, type, link) VALUES ('" + name[x] + "', '" + host[x] + "', '" + ty[x] + "', '" + link[x] + "');"
        ourcursor.execute(sql)
        ourdb.commit()

    # ran = len(name)
    
    # for x in range(ran):

    #     print("\n--------------------- ", x ," -----------------------\n")
    #     print(name[x])
    #     print(host[x])
    #     print(ty[x])
    #     print(link[x])

        
            
def main():
    edX()

if __name__ == "__main__":
    main()
    
ourdb.close()