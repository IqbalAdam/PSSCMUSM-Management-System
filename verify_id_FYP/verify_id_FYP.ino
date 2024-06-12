#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 10
#define RST_PIN 9
MFRC522 rfid(SS_PIN, RST_PIN);

MFRC522::MIFARE_Key key;

void setup() {
  Serial.begin(9600);
  SPI.begin();
  rfid.PCD_Init();

  // Prepare the security key for the RFID card
  for (byte i = 0; i < 6; i++) key.keyByte[i] = 0xFF;
}

void loop() {
  // Look for new cards
  if (!rfid.PICC_IsNewCardPresent()) return;
  if (!rfid.PICC_ReadCardSerial()) return;

  // Read from the card
  byte sector = 1;
  byte blockAddr = 4;
  byte trailerBlock = 7;
  MFRC522::StatusCode status;
  byte buffer[18];
  byte size = sizeof(buffer);

  // Authenticate
  status = (MFRC522::StatusCode)rfid.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, trailerBlock, &key, &(rfid.uid));
  if (status != MFRC522::STATUS_OK) {
    Serial.print("PCD_Authenticate() failed: ");
    Serial.println(rfid.GetStatusCodeName(status));
    return;
  }

  // Read block
  status = (MFRC522::StatusCode)rfid.MIFARE_Read(blockAddr, buffer, &size);
  if (status != MFRC522::STATUS_OK) {
    Serial.print("MIFARE_Read() failed: ");
    Serial.println(rfid.GetStatusCodeName(status));
    return;
  }

  // Find and print the first non-zero byte
  bool printed = false;
  for (byte i = 0; i < 16; i++) {
    if (buffer[i] != 0) {
      Serial.print(buffer[i], HEX);
      printed = true;
      break;
    }
  }
  if (!printed) {
    Serial.print("No non-zero data found");
  }
  Serial.println();

  // Halt PICC
  rfid.PICC_HaltA();

  // Stop encryption on PCD
  rfid.PCD_StopCrypto1();
  delay(1000); // Add delay to allow user to remove the card
}
