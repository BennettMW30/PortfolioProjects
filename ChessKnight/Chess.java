package Chess;

import java.util.*;

public class Chess
{
	int boardSize, goalPos, startPos;
	int[][] adjMatrix;
	int[] dist;
	int[] pred;
	int[] path;
	boolean[] visited;
	int totalDistance = Integer.MAX_VALUE;
	
	public int Run(int boardSize, int startPos, int goalPos)
	{
		//initialize variables
		this.boardSize = boardSize;
		this.goalPos = goalPos;
		this.startPos = startPos;
		
		//Create and fill the adjacency matrix
		adjMatrix = new int[boardSize*boardSize][boardSize*boardSize];
		for(int k1 = 0; k1 < boardSize*boardSize; k1++)
		{
			for(int k2 = 0; k2 < boardSize*boardSize; k2++)
			{
				if(Math.abs((Math.abs(((k1 / boardSize) + 1) - ((k2 / boardSize) + 1))) * Math.abs(((k1 % boardSize) + 1) - ((k2 % boardSize) + 1))) == 2)
				{
					adjMatrix[k1][k2] = 1;
				}
				else
				{
					adjMatrix[k1][k2] = 0;
				}
			}
		}
		
		//Use this code to test the values in the adjacency matrix
		/*for(int i = 0; i < boardSize*boardSize; i++)
		{
			for(int j = 0; j < boardSize*boardSize; j++)
			{
				System.out.print(adjMatrix[i][j] + " ");
			}
			System.out.println();
		}*/
		
		//create lists for the values that dijkstra's algorithm keeps track of
		dist = new int[boardSize*boardSize];
		pred = new int[boardSize*boardSize];
		visited = new boolean[boardSize*boardSize];
		
		//set all distances to infinity to be lowered as the algorithm goes along
		for(int i = 0; i < boardSize*boardSize; i++)
		{
			dist[i] = Integer.MAX_VALUE;
			visited[i] = false;
		}
		
		//the distance from start to start is 0
		dist[startPos] = 0;
		
		Dijkstra(startPos, goalPos, 0);
		
		//Use this to display the distance, pred, and visited arrays
		/*System.out.println();
		for(int i = 0; i < boardSize*boardSize; i++)
		{
			System.out.print(dist[i] + " ");
		}
		System.out.println();
		for(int i = 0; i < boardSize*boardSize; i++)
		{
			System.out.print(visited[i] + " ");
		}
		System.out.println();
		for(int i = 0; i < boardSize*boardSize; i++)
		{
			System.out.print(pred[i] + " ");
		}
		System.out.println();*/
		
		return totalDistance;
	}
	
	public void PrintPath()
	{
		String pathString = "";
		for(int i = 0; i < totalDistance; i++)
		{
			int temp = path[i];
			int newI = (temp/boardSize) + 1;
			int newJ = (temp%boardSize) + 1;
			pathString += " -> (" + newI + ", " + newJ + ")";
		}
		int startPosString = startPos;
		int startPosI = (startPosString/boardSize) + 1;
		int startPosJ = (startPosString%boardSize) + 1;
		System.out.println("The path that the knight traveled was (" + startPosI + ", " + startPosJ + ")" + pathString);
	}
	
	//Start using dijkstra's algorithm
	public void Dijkstra(int start, int end, int distance)
	{
		int lowestDistance = Integer.MAX_VALUE - 1;
		visited[start] = true;
		if(start == end)
		{
			totalDistance = dist[end];
			if(totalDistance > 0)
			{
				int current = end;
				
				path = new int[totalDistance];
				path[totalDistance - 1] = end;
				for(int i = totalDistance - 2; i >= 0; i--)
				{
					path[i] = pred[current];
					current = pred[current];
				}
			}
			
			return;
		}
		if(visited[end] == true)
		{
			return;
		}
		for(int i = 0; i < boardSize*boardSize; i++)
		{
			if(adjMatrix[start][i] == 1 && visited[i] == false)
			{
				pred[i] = start;
				dist[i] = distance+1;
			}
		}
		for(int i = 0; i < boardSize*boardSize; i++)
		{
			if(visited[i] == false && dist[i] < lowestDistance)
			{
				lowestDistance = dist[i];
			}
		}
		for(int i = 0; i < boardSize*boardSize; i++)
		{
			if(visited[i] == false && dist[i] == lowestDistance)
			{
				Dijkstra(i, end, lowestDistance);
			}
		}
	}
	
	public static void main(String[] args)
	{
		Scanner in = new Scanner(System.in);
		System.out.println("Please enter the board size");
		int bSize = in.nextInt();
		in.nextLine();
		int start = 0;
		int startI = -1;
		int startJ = -1;
		System.out.println("Please enter the starting position in this format -> (i, j)");
		while(startI > bSize || startI <= 0 || startJ > bSize || startJ <= 0)
		{
			int temp = 0;
			String startString = in.nextLine();
			if(startString.equals(""))
			{
				startString = "(" + (bSize+1) + ", " + (bSize+1) + ")";
				//System.out.println(startString);
			}
			for(int i = 0; i < startString.length(); i++)
			{
				if(startString.substring(i, i+1).equals(","))
				{
					temp = i;
					startI = Integer.parseInt(startString.substring(1, i));
					//System.out.println(startI);
				}
			}
			for(int i = 0; i < startString.length(); i++)
			{
				if(startString.substring(i, i+1).equals(")"))
				{
					if(startString.substring(temp+1, temp+2).equals(" "))
					{
						startJ = Integer.parseInt(startString.substring(temp+2, i));
					}
					else
					{
						startJ = Integer.parseInt(startString.substring(temp+1, i));
					}
					//System.out.println(startJ);
				}
			}
			if(startI > bSize || startI <= 0 || startJ > bSize || startJ <= 0)
			{
				System.out.println("Please enter valid numbers for the starting position (between 1 and " + bSize + ")");
			}
			start = bSize*(startI-1) + (startJ-1);
			//System.out.println(start);
		}
		int end = 0;
		int endI = -1;
		int endJ = -1;
		System.out.println("Please enter the goal position in this format -> (i, j)");
		while(endI > bSize || endI <= 0 || endJ > bSize || endJ <= 0)
		{
			int temp = 0;
			String endString = in.nextLine();
			if(endString.equals(""))
			{
				endString = "(" + (bSize+1) + ", " + (bSize+1) + ")";
				//System.out.println(startString);
			}
			for(int i = 0; i < endString.length(); i++)
			{
				if(endString.substring(i, i+1).equals(","))
				{
					temp = i;
					endI = Integer.parseInt(endString.substring(1, i));
					//System.out.println(endI);
				}
			}
			for(int i = 0; i < endString.length(); i++)
			{
				if(endString.substring(i, i+1).equals(")"))
				{
					if(endString.substring(temp+1, temp+2).equals(" "))
					{
						endJ = Integer.parseInt(endString.substring(temp+2, i));
					}
					else
					{
						endJ = Integer.parseInt(endString.substring(temp+1, i));
					}
					//System.out.println(endJ);
				}
			}
			if(endI > bSize || endI <= 0 || endJ > bSize || endJ <= 0)
			{
				System.out.println("Please enter valid numbers for the goal position (between 1 and " + bSize + ")");
			}
			end = bSize*(endI-1) + (endJ-1);
			//System.out.println(end);
		}
		
		Chess obj = new Chess();
		
		int numMoves = obj.Run(bSize, start, end);
		if(numMoves < 0 || numMoves == Integer.MAX_VALUE)
		{
			System.out.print("It is impossible to reach the goal from this spot");
		}
		else
		{
			System.out.println("The minimum number of moves is " + numMoves);
			obj.PrintPath();
		}
	}
}
