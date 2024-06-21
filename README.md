This is repository for Final Year Project and serve Persatuan Seni Silat Cekak Malaysia USM (PSSCMUSM) as client
A web application named PSSCMUSM Management System (PMS)
Purposely to digitalize current administration operations in PSSCMUSM
Created by Muhammad Iqbal Adam (iqbaladam00@outlook.com)

This project involve 3 modules up until May 2024:
- Student Data Management
- Attendance & Records
- Data Visualization

Each modules is a solution to each one of the client's problem statements

Introduction:
PMS utilize RFID technology with Arduino Uno to create the main feature which is recording attendance by using Message Queuing Telemetry Transport (MQTT)

Process of Recording Attendance:
1. A student ID was written on the card.
2. Card scanned on the RFID scanner (RC522) and read written ID.
3. The ID will be published to a MQTT topic (attendance/rfid) through MQTT Websocket Client in HiveMQ.
4. Node-Red also used to transport the scan output to MQTT topic.
5. A PHP script will subscribe to the MQTT topic and listen for the latest message under that topic.
6. Once message received, PHP script will fetch student details by passing the ID as parameter.
7. Student details will be displayed in the HTML.

System Demo Video:
https://www.youtube.com/watch?v=4qrgcE3jWM0&ab_channel=IqbalAdam

older repository name (iqbal_FYP)
was updated on 22/6/2024
