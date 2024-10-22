//Read test is a testing to see what information has been written in the RFID card. 
//To see what student information has been written to identify the process of writing info into RFID is successful or not
//Run this code in Arduino IDE
#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 10
#define RST_PIN 9

MFRC522 mfrc522(SS_PIN, RST_PIN);  // Create MFRC522 instance.

void setup() {
  Serial.begin(9600);  // Initialize serial communication.
  SPI.begin();          // Init SPI bus.
  mfrc522.PCD_Init();   // Init MFRC522 card.

  Serial.println("Ready to read data. Scan a RFID card...");
}

void loop() {
  // Look for new cards.
  if (!mfrc522.PICC_IsNewCardPresent() || !mfrc522.PICC_ReadCardSerial()) {
    delay(50);
    return;
  }

  // Show some details of the PICC (card).
  Serial.println("Card detected!");

  // Read data from the card.
  byte blockAddr = 1; // Assuming data is written to block 1
  byte buffer[18];
  byte size = sizeof(buffer);

  MFRC522::StatusCode status = mfrc522.MIFARE_Read(blockAddr, buffer, &size);
  if (status == MFRC522::StatusCode::STATUS_OK) {
    Serial.println("Data read successfully:");

    // Convert byte array to strings
    String name = "", matricID = "", icNumber = "", gender = "", school = "";
    for (int i = 0; i < size; i++) {
      if (buffer[i] != 0) {
        name += (char)buffer[i];
      } else {
        break;
      }
    }
    for (int i = 16; i < size; i++) {
      if (buffer[i] != 0) {
        matricID += (char)buffer[i];
      } else {
        break;
      }
    }
    for (int i = 32; i < size; i++) {
      if (buffer[i] != 0) {
        icNumber += (char)buffer[i];
      } else {
        break;
      }
    }
    for (int i = 48; i < size; i++) {
      if (buffer[i] != 0) {
        gender += (char)buffer[i];
      } else {
        break;
      }
    }
    for (int i = 64; i < size; i++) {
      if (buffer[i] != 0) {
        school += (char)buffer[i];
      } else {
        break;
      }
    }

    // Display the data
    Serial.print("Name: "); Serial.println(name);
    Serial.print("Matric ID: "); Serial.println(matricID);
    Serial.print("IC Number: "); Serial.println(icNumber);
    Serial.print("Gender: "); Serial.println(gender);
    Serial.print("School: "); Serial.println(school);
  } else {
    Serial.print("Error reading data from the card! Status code: ");
    Serial.println(mfrc522.GetStatusCodeName(status));
  }

  // Halt PICC (card) to stop communication.
  mfrc522.PICC_HaltA();

  // Stop encryption on PCD (reader).
  mfrc522.PCD_StopCrypto1();

  // Delay before looking for a new card
  delay(2000);
}
