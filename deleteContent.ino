#include <SPI.h>
#include <MFRC522.h>

#define RST_PIN 9     // Reset pin
#define SS_PIN 10     // Slave Select pin

MFRC522 mfrc522(SS_PIN, RST_PIN);  // Create MFRC522 instance

void setup() {
  Serial.begin(9600);   // Initialize serial communication
  SPI.begin();          // Init SPI bus
  mfrc522.PCD_Init();   // Init MFRC522 card

  Serial.println("Scan an RFID card to delete its content...");
}

void loop() {
  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent() || ! mfrc522.PICC_ReadCardSerial()) {
    delay(50);
    return;
  }

  // Clear card's content
  if (mfrc522.MIFARE_Write(4, NULL, 0)) {
    Serial.println("Content deleted successfully!");
  } else {
    Serial.println("Error deleting content!");
  }

  // Halt PICC
  mfrc522.PICC_HaltA();

  // Stop encryption on PCD
  mfrc522.PCD_StopCrypto1();
}