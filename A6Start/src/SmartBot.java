import battleship.BattleShip;
import battleship.CellState;

import java.awt.*;
import java.util.LinkedList;

/**
 * @author  Frank Kufer
 * @author  George Mathioudakis
 *
 * This class is designed to create a bot that  used to shoot
 * on a board in the least amount of shots
 */
public class SmartBot {
    //  size of the board being played on
    private int gameSize;
    // battle ship used to shoot with
    private BattleShip battleShip;
    private  int shipsSunk = 0;
    // keeps track of each shot the ship takes-
    private SimpleHashSet<Point> trackShots = new SimpleHashSet<>();
    // first stores the first hit if it finds the ship at that spot
    private Point first;
    // current stores the second hit after first is initiated and keeps updating till it it sunks the ship
    private Point current;
    // changes state mode to attack if true or search if false
    private boolean hit = false;
    // up, down, right, and left are to be used to determine on which direction the next shot will be hitting
    boolean up = true;
    private boolean down = true;
    private boolean left = true;
    private boolean right = true;
    // one, two, three, and four are to be used for edges cases for battleship board
    private boolean one = true;
    private boolean two = true;
    private boolean three = true;
    private boolean four = true;
    //2D array ius used to create the battleship board
    private CellState[][] board = new CellState[10][10];


    /**
     * constructor for the bot
     * @param battleShip uses to fire at the board
     */
    public SmartBot(BattleShip battleShip) {
        this.gameSize = battleShip.boardSize;
        this.battleShip = battleShip;
        for(int i=0;i<board.length;i++){
            for(int j=0;j<board[i].length;j++){
                board[i][j]=CellState.Empty;
            }
        }


    }

    /**
     * This method  has two states one is used to searching for spots to find a ship then changing into attack mode
     * until a ship is sunken returning each shot back everytime
     *
     * @return searchHit if the shot hits or misses
     */
    public boolean fireShot() {
        boolean searchHit = false;
        boolean shot = false;

// Attack mode---------------------------------------------------------------------------------------------------
        if (hit) {

            // if x is 0 turn off up attack
            if (current.x == 0) {
                up = false;
                if(first.x==0){
                    one = false;
                }
                if(one){
                    current = new Point(first);
                }
            }
            // if x is 9 turn off down attack
            if (current.x == 9) {
                down = false;
                if(first.x==9){
                    two = false;
                }
                if(two){
                    current = new Point(first);
                }
            }

            // if y is 0 turn off left attack
            if (current.y == 0) {
                left = false;
                if(first.y==0){
                    three = false;
                }
                if(three){
                    current = new Point(first);
                }
            }
            // if y is 9 turn off right attack
            if (current.y == 9) {
                right = false;
                if(first.y==9){
                    four = false;
                }
                if(four){
                    current = new Point(first);
                }

            }
            // if up is true start to hit toward up direction
            if (up) {
                Point point1 = new Point(current.x - 1, current.y);
                //if it contains the hit do not hit again
                if (!trackShots.contains(point1)) {
                    searchHit = battleShip.shoot(point1);
                    //ad the shot to the trackshots
                    trackShots.insert(point1);
                    //if true set current to that shot
                    if (searchHit) {
                        board[point1.x][point1.y]= CellState.Hit;
                            current = new Point(point1);
                    }
                    // set current to to the first hit again and set the up flag to false
                    else {
                        board[point1.x][point1.y]= CellState.Miss;
                        up = false;
                        current = new Point(first);

                    }

                // turn off the up flag and start other directions and set current to first hit
                }else {
                    up = false;
                    current = new Point(first);
                }

            }
            // if right is true start to hit toward right direction
            else if (right) {

                Point point1 = new Point(current.x, current.y + 1);
                if (!trackShots.contains(point1)) {
                    searchHit = battleShip.shoot(point1);
                    trackShots.insert(point1);
                    if (searchHit) {
                        board[point1.x][point1.y]= CellState.Hit;
                        current = new Point(point1);
                    } else {
                        board[point1.x][point1.y]= CellState.Miss;
                        right = false;
                        current = new Point(first);
                    }

                }
                // turn off the right flag and start other directions and set current to first hit
                else {

                    right = false;
                    current = new Point(first);

                }

            }
            // if down is true start to hit toward down direction
            else if (down) {
                Point point1 = new Point(current.x + 1, current.y);
                if (!trackShots.contains(point1)) {
                    searchHit = battleShip.shoot(point1);
                    trackShots.insert(point1);
                    if (searchHit) {
                        board[point1.x][point1.y]= CellState.Hit;
                        current = new Point(point1);

                    } else {
                        board[point1.x][point1.y]= CellState.Miss;
                        down = false;
                        current = new Point(first);
                    }

                }
                // turn off the down flag and start other directions and set current to first hit
                else {
                    down = false;
                    current = new Point(first.x, first.y);
                }

            }
            // if left is true start to hit toward left direction
            else if (left){
                Point point1 = new Point(current.x, current.y - 1);

                if (!trackShots.contains(point1)) {
                    searchHit = battleShip.shoot(point1);
                    trackShots.insert(point1);
                    if (searchHit) {
                        board[point1.x][point1.y]= CellState.Hit;
                        current = new Point(point1);

                    } else {
                        board[point1.x][point1.y]= CellState.Miss;
                        left = false;
                        current = new Point(first);
                    }

                }
                // turn off the left flag and start other directions and set current to first hit
                else {
                    left = false;
                    current = new Point(first);
                }
            }
            //if it does not sink a ship on the attack mode and can not find all the direction
            if(!up && !down && !right && !left ){
               hit = false;
                up = true;
                down = true;
                left = true;
                right = true;
                one = true;
                two = true;
                three = true;
                four = true;
            }
            //if the ship is sunk set everything to default state then switch to search mode
            int shipsSunk = this.battleShip.numberOfShipsSunk();
            if (this.shipsSunk < shipsSunk ) {

                hit = false;
                this.shipsSunk = shipsSunk;
                up = true;
                down = true;
                left = true;
                right = true;
                one = true;
                two = true;
                three = true;
                four = true;

                //this loop is to print out the board with all the hits and misses
                for(int i=0;i<board.length;i++){
                    for(int j=0;j<board[i].length;j++){
                      //  System.out.print(board[i][j]+"\t");
                    }
                  //  System.out.println("");
                }
              //  System.out.println("...."+trackShots);
            }



        }

// Search mode---------------------------------------------------------------------------------------------------
        else {


            //start from top left of the board
            for (int x = 0; x < gameSize; x++) {

                //if even numbers
                if (x % 2 == 0) {
                    for (int y = 0; y < gameSize; y += 2) {
                        // create a new point from x and y
                        Point point = new Point(x, y);
                        //check if the point already exist in the trackShots
                        if (!trackShots.contains(point)) {
                            searchHit = battleShip.shoot(point);
                            //insert it in trackShots if it was not there
                            trackShots.insert(point);
                            // if the hit is true set the first and current to the one point and switch to attack state
                            if (searchHit) {
                                board[x][y]= CellState.Hit;
                                first = new Point(point);
                                current = new Point(point);
                                hit = true;
                                //otherwise break out of the loop  and set shot to true
                            } else {
                                board[x][y]= CellState.Miss;
                            }
                            shot = true;
                            break;

                        }

                    }


                //otherwise odd numbers
                } else {
                    for (int y = 1; y < gameSize; y += 2) {
                        // create a new point from x and y
                        Point point = new Point(x, y);
                        //check if the point already exist in the trackShots
                        if (!trackShots.contains(point)) {
                            searchHit = battleShip.shoot(point);
                            //insert it in trackShots if it was not there
                            trackShots.insert(point);
                            // if the hit is true set the first and current to the one point and switch to attack
                            if (searchHit) {
                                board[x][y]= CellState.Hit;
                                first = new Point(point);
                                current = new Point(point);
                                hit = true;

                            }
                            //otherwise break out of the loop and set shot to true
                            else {
                                board[x][y]= CellState.Miss;
                            }
                            shot = true;
                            break;

                        }
                        //if it does not sunk all the ship it will search the board spot were not shot before
                        if(x==9 && y==9 && !shot){
                            for(int i = 0; i<gameSize;i++){
                                for(int j=0; j<gameSize;j++){
                                    Point point1 = new Point(i, j);
                                    if(!trackShots.contains(point1)){
                                        searchHit = battleShip.shoot(point1);
                                        trackShots.insert(point1);
                                        shot = true;
                                        hit = true;
                                        break;
                                    }

                                }
                                // will only break out of the loop if a shot is taken
                                if(shot){
                                    break;
                                }
                            }

                        }
                    }

                }


                if (shot) {
                    break;
                }

            }


        }
        return searchHit;
    }
}
