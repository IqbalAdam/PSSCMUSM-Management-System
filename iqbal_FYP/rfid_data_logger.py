import serial
import time
import csv
import os

# Serial port configuration
SERIAL_PORT = 'COM6'  # Change this to match your Arduino's serial port
BAUD_RATE = 9600
ser = serial.Serial(SERIAL_PORT, BAUD_RATE)

# Function to create or append to the CSV file
def append_to_csv(data):
    file_exists = os.path.isfile('rfid_data.csv')
    with open('rfid_data.csv', 'a', newline='') as file:
        writer = csv.writer(file)
        if not file_exists:
            writer.writerow(['UID', 'Timestamp'])
        writer.writerow(data)

# Main loop to read data from Arduino and write to CSV
try:
    while True:
        if ser.in_waiting > 0:
            data = ser.readline().decode().strip()
            print("Data received from Arduino:", data)  # Print the received data
            if ',' in data:
                uid, timestamp = data.split(',')
                append_to_csv([uid.split(':')[1], timestamp.split(':')[1]])
            else:
                print("Error: Received data does not contain a comma.")
except KeyboardInterrupt:
    ser.close()
    print("Program terminated by user.")