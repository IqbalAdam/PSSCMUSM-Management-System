<?php
// Intesting phase...still not working
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    // Arduino sketch template
    $arduino_code = <<<EOD
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

  Serial.println("Place your card to the reader...");
}

void loop() {
  // Look for new cards
  if (!rfid.PICC_IsNewCardPresent()) return;
  if (!rfid.PICC_ReadCardSerial()) return;

  // Show UID on serial monitor
  Serial.print("Card UID:");
  for (byte i = 0; i < rfid.uid.size; i++) {
    Serial.print(rfid.uid.uidByte[i] < 0x10 ? " 0" : " ");
    Serial.print(rfid.uid.uidByte[i], HEX);
  }
  Serial.println();

  // Write to the card
  byte sector = 1;
  byte blockAddr = 4;
  byte trailerBlock = 7;
  MFRC522::StatusCode status;
  byte buffer[18];

  byte id = $id; // Your 'id' value to write
  byte dataBlock[] = { id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 };

  // Authenticate
  status = (MFRC522::StatusCode)rfid.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, trailerBlock, &key, &(rfid.uid));
  if (status != MFRC522::STATUS_OK) {
    Serial.print("PCD_Authenticate() failed: ");
    Serial.println(rfid.GetStatusCodeName(status));
    return;
  }

  // Write block
  status = (MFRC522::StatusCode)rfid.MIFARE_Write(blockAddr, dataBlock, 16);
  if (status != MFRC522::STATUS_OK) {
    Serial.print("MIFARE_Write() failed: ");
    Serial.println(rfid.GetStatusCodeName(status));
    return;
  }
  Serial.println("Data was written into the card!");

  // Halt PICC
  rfid.PICC_HaltA();

  // Stop encryption on PCD
  rfid.PCD_StopCrypto1();
  delay(1000); // Add delay to allow user to remove the card
}
EOD;

    // Save the modified Arduino sketch to a temporary file
    $filename = tempnam(sys_get_temp_dir(), 'arduino_sketch') . '.ino';
    file_put_contents($filename, $arduino_code);

    // Command to upload the Arduino sketch
    $upload_command = "arduino-cli compile --upload -b arduino:avr:uno -p /dev/ttyACM0 $filename";
    $output = shell_exec($upload_command);

    echo "ID $id written to the RFID card.<br>";
    echo "Output:<br><pre>$output</pre>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>RFID Student ID Writer</title>
</head>
<body>
    <h1>Write Student ID to RFID Card</h1>
    <form method="POST" action="">
        <label for="id">Student ID:</label>
        <input type="number" id="id" name="id" required>
        <button type="submit">Scan</button>
    </form>
</body>
</html>
