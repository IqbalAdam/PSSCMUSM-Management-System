import serial
import time
import paho.mqtt.client as mqtt
import mysql.connector
import json

# Configure the serial connection to Arduino
arduino_port = 'COM3'  # Change this to your Arduino's serial port
baud_rate = 9600
ser = serial.Serial(arduino_port, baud_rate, timeout=1)

# Configure the MQTT client
mqtt_broker = "broker.hivemq.com"
mqtt_topic = "attendance/rfid"
client = mqtt.Client("RFID_Client")
client.connect(mqtt_broker, 1883, 60)

# Configure the MySQL connection
db = mysql.connector.connect(
    host="localhost",
    user="your_mysql_username",
    password="your_mysql_password",
    database="pms"
)

cursor = db.cursor()

def fetch_student_details(rfid_id):
    query = "SELECT id, full_name, matric_ID, gender, school, image FROM student WHERE id = %s"
    cursor.execute(query, (rfid_id,))
    return cursor.fetchone()

while True:
    if ser.in_waiting > 0:
        line = ser.readline().decode('utf-8').strip()
        if "RFID ID:" in line:
            rfid_id = int(line.split(":")[1].strip())
            print(f"Read RFID ID: {rfid_id}")
            
            student_details = fetch_student_details(rfid_id)
            if student_details:
                data = {
                    "id": student_details[0],
                    "full_name": student_details[1],
                    "matric_ID": student_details[2],
                    "gender": student_details[3],
                    "school": student_details[4],
                    "image": student_details[5]
                }
                client.publish(mqtt_topic, json.dumps(data))
                print(f"Published to MQTT: {data}")
            else:
                print(f"No student found for RFID ID: {rfid_id}")
        
    time.sleep(1)
