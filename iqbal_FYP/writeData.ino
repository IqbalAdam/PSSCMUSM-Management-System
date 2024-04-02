#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 10
#define RST_PIN 9

MFRC522 mfrc522(SS_PIN, RST_PIN);  // Create MFRC522 instance.

void setup() {
  Serial.begin(9600);  // Initialize serial communication.
  SPI.begin();          // Init SPI bus.
  mfrc522.PCD_Init();   // Init MFRC522 card.

  Serial.println("Scan a RFID card to write data...");
}

void loop() {
  // Look for new cards.
  if (!mfrc522.PICC_IsNewCardPresent() || !mfrc522.PICC_ReadCardSerial()) {
    delay(50);
    return;
  }

  // Show some details of the PICC (card).
  Serial.print(F("Card UID:"));
  dump_byte_array(mfrc522.uid.uidByte, mfrc522.uid.size);
  Serial.println();

  // Prepare data to write onto the card.
  String name = "Muhammad Iqbal Adam Bin Mohamad Saupi";
  String matricID = "150632";
  String icNumber = "000222140229"; // Replace XXXXXXXXX with actual IC number
  String gender = "Male";
  String school = "Computer Science";
  String image = "https://drive.google.com/file/d/1_1M6jZPN_nlTxsXkzAjBfTbnfUfPJ9_R/view?usp=drive_link";

  // Convert data to bytes if necessary.
  byte data[64]; // Adjust size as per your data size.
  name.getBytes(data, name.length() + 1);
  matricID.getBytes(data + name.length() + 1, matricID.length() + 1);
  icNumber.getBytes(data + name.length() + matricID.length() + 2, icNumber.length() + 1);
  gender.getBytes(data + name.length() + matricID.length() + icNumber.length() + 3, gender.length() + 1);
  school.getBytes(data + name.length() + matricID.length() + icNumber.length() + gender.length() + 4, school.length() + 1);
  // Repeat for other data attributes.

  // Write data onto the card.
  mfrc522.MIFARE_Write(1, data, 64); // Write to block 1

  Serial.println("Data written successfully.");

  // Halt PICC (card) to stop communication.
  mfrc522.PICC_HaltA();

  // Stop encryption on PCD (reader).
  mfrc522.PCD_StopCrypto1();
}

void dump_byte_array(byte *buffer, byte bufferSize) {
  for (byte i = 0; i < bufferSize; i++) {
    Serial.print(buffer[i] < 0x10 ? " 0" : " ");
    Serial.print(buffer[i], HEX);
  }
}
