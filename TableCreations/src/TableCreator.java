import java.sql.* ;



public class TableCreator {

	private static TableCreator cm = new TableCreator();
	private static Connection con;
	private Statement stmt;
	
	//Creates the connection to mysql server
	private TableCreator(){	

		try{
			Class.forName("com.mysql.jdbc.Driver");
			con = DriverManager.getConnection("jdbc:mysql://dijkstra2.ug.bcc.bilkent.edu.tr/test", "gulsum.gudukbay", "ibdb8y1ir");
			stmt = con.createStatement();
		}catch(SQLException ex){
			ex.printStackTrace();
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
			
	}
	
	//singleton design pattern to ensure that only one connection is made
	public static TableCreator getSoleInstance(){
		return cm;
	}
	
	//Creates a statement
	public static Statement createStmt() {
		try {
			return con.createStatement();
		} catch (SQLException e) {
			e.printStackTrace();
			return null;
		}
	}
	
	
	public static void main(String[] args) {
		TableCreator cl = TableCreator.getSoleInstance();
		Statement stmt = TableCreator.createStmt();
		try {
			stmt.execute("DROP TABLE IF EXISTS owns;");
			stmt.execute("DROP TABLE IF EXISTS customer;");
			stmt.execute("DROP TABLE IF EXISTS account;");
			stmt.execute("DROP TABLE IF EXISTS Company;");


			stmt.execute("DROP TABLE IF EXISTS Endorsement;");
			stmt.execute("DROP TABLE IF EXISTS DeveloperSkill;");
			stmt.execute("DROP TABLE IF EXISTS Skill;");
			stmt.execute("DROP TABLE IF EXISTS Developer;");
			stmt.execute("DROP TABLE IF EXISTS User;");

			stmt.executeUpdate("CREATE TABLE User(user_id int PRIMARY KEY, "
													+ "username	varchar(40)	NOT NULL, "
													+ "name varchar(40)	NOT NULL, "
													+ "email varchar(100) NOT NULL, "
													+ "password varchar(40) NOT NULL, "
													+ "website varchar(100), "
													+ "biography varchar(500) ) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE Developer( user_id int PRIMARY KEY, "
													+ "school varchar(40) NOT NULL, "
													+ "FOREIGN KEY (user_id) references User(user_id)) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE Company( user_id int PRIMARY KEY, "
													+ "company_name varchar(40) NOT NULL, "
													+ "FOREIGN KEY (user_id) references User(user_id)) ENGINE = InnoDB;");
			/////
			stmt.executeUpdate("CREATE TABLE Skill( skill_id int PRIMARY KEY, "
													+ "name varchar(40)	NOT NULL) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE Endorsement ( skill_id int, "
													+ "to_id int, "
													+ "from_id int, "
													+ "PRIMARY KEY (skill_id, to_id, from_id), "
													+ "FOREIGN KEY (skill_id) references Skill(skill_id), "
													+ "FOREIGN KEY (to_id) references User(user_id), "
													+ "FOREIGN KEY (from_id) references User(user_id))  ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE DeveloperSkill (skill_id int, "
													+ "user_id int, "
													+ "PRIMARY KEY (skill_id, user_id), "
													+ "FOREIGN KEY (skill_id) references Skill(skill_id), "
													+ "FOREIGN KEY (user_id) references Developer(user_id))  ENGINE = InnoDB;");


		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

}
