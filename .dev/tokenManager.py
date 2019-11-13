import requests
import json
import mysql.connector
import time
mydb = mysql.connector.connect(
      host="localhost",
      user="markg",
      passwd="/someWHERE924",
      database="spotifyData"
)
class userData:
    def __init__(self, userID, userCode):
        self.userID = userID
        self.userCode = userCode



def updateToken():
    openList = []
    mycursor = mydb.cursor()
    mycursor.execute("SELECT userCode.userID, userCode.userCode FROM userCode INNER JOIN userToken ON userCode.userID = userToken.tokenID WHERE userToken.access_token =''")
    myresult = mycursor.fetchall()
    for x in myresult:
        openList.append(userData(x[0], x[1]))
    for i in openList:
        url = "https://accounts.spotify.com/api/token"
        data = {'grant_type':"authorization_code", 
            'code':i.userCode, 
            'redirect_uri':'https://www.tldl.dev/signup.php', 
            'client_id':'c3b3d7061e6a45e391484f8dd9a4713f',
            'client_secret':'23bd6658d96e4711b3f79ba149819c75'}
        r = requests.post(url = url, data = data)
        data = r.json()
        try:
            #updates usercode with id
            mycursor = mydb.cursor()
            sql = "UPDATE userToken SET access_token = '" + str(data["access_token"]) + "', scope = '" + str(data["scope"]) + "', expires_in = '" + str(data["expires_in"]) + "', refresh_token = '" + str(data["refresh_token"]) + "' WHERE tokenID = '" + str(i.userID) + "'"
            mycursor.execute(sql)
            mydb.commit()
            print(mycursor.rowcount, "record(s) affected")
        except Exception as e:
            print(e)
    time.sleep(1)
def hourlyUpdate():
    openList = []
    mycursor = mydb.cursor()
    mycursor.execute("SELECT tokenID, refresh_token FROM userToken")
    myresult = mycursor.fetchall()
    for x in myresult:
        openList.append(userData(x[0], x[1]))
    for i in openList:
        url = "https://accounts.spotify.com/api/token"
        data = {'grant_type':"refresh_token", 
            'refresh_token':i.userCode, 
            'client_id':'c3b3d7061e6a45e391484f8dd9a4713f',
            'client_secret':'23bd6658d96e4711b3f79ba149819c75'}
        r = requests.post(url = url, data = data)
        data = r.json()
        print(data)
        try:
            #updates usercode with id
            mycursor = mydb.cursor()
            sql = "UPDATE userToken SET access_token = '" + str(data["access_token"]) + "', scope = '" + str(data["scope"]) + "', expires_in = '" + str(data["expires_in"]) + "' WHERE tokenID = '" + str(i.userID) + "'"
            mycursor.execute(sql)
            mydb.commit()
            print(mycursor.rowcount, "record(s) affected")
        except:
            hourlyUpdate()
def recommended(email):
    url = "https://www.tldl.dev/top50.php?email="+email
    r = requests.get(url = url)
    print(r)
recommended('mark924')

