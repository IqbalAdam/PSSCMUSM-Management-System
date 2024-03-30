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
  if ( ! mfrc522.PICC_IsNewCardPresent() || ! mfrc522.PICC_ReadCardSerial()) {
    delay(50);
    return;
  }

  // Show some details of the PICC (card).
  Serial.print(F("Card UID:"));
  dump_byte_array(mfrc522.uid.uidByte, mfrc522.uid.size);
  Serial.println();

  // Prepare data to write onto the card.
  // You'll need to replace these dummy values with the actual data you want to write.
  String name = "Muhammad Iqbal Adam Bin Mohamad Saupi";
  String matricID = "150632";
  String gender = "Male";
  String school = "Computer Science";
  String image = "https://drive.google.com/file/d/1_1M6jZPN_nlTxsXkzAjBfTbnfUfPJ9_R/view?usp=drive_link"; // You might need to store image path instead of the actual image.

  // Convert data to bytes if necessary.
  byte data[64]; // Adjust size as per your data size.
  name.getBytes(data, name.length() + 1);
  // Repeat for other data attributes.

  // Write data onto the card.
  mfrc522.MIFARE_Write(1, data, 64);

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
