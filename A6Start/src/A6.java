import battleship.BattleShip;

/**
 * @author Frank Kufer
 * @author George Mathioudakis

 * This class is designed to let a  bot for battleship shoot at a board with 5
 * ships that take up 17 spot on the board of 100 in the least amount of shots
 * in 10000 games.
 */
public class A6
{
  static final int NUMBEROFGAMES = 10000;

  /**
   * This method is used to run the battle ship game and let the bot take shots at the board while tracking the shot and time it takes to run
   */
  public static void startingSolution()
  {
    int totalShots = 0;
    System.out.println(BattleShip.version());
    long start = System.nanoTime();
    for (int game = 0; game < NUMBEROFGAMES; game++) {

      BattleShip battleShip = new BattleShip();
      SmartBot smartBot = new SmartBot(battleShip);


      while (!battleShip.allSunk()) {
        smartBot.fireShot();

      }
      int gameShots = battleShip.totalShotsTaken();
      totalShots += gameShots;
    }
    long finish = System.nanoTime();
    System.out.println((finish-start)/1000000000.0+" second(s) to finish");
    System.out.printf("SmartBot - The Average # of Shots required in %d games to sink all Ships = %.2f\n", NUMBEROFGAMES, (double)totalShots / NUMBEROFGAMES);

  }

  /**
   * this method is used to call the starting solution method
   *
   * @param args not used
   */
  public static void main(String[] args)
  {
    startingSolution();
  }
}