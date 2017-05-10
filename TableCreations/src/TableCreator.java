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

			stmt.execute("DROP TABLE IF EXISTS Endorsement;");
			stmt.execute("DROP TABLE IF EXISTS DeveloperSkill;");
			stmt.execute("DROP TABLE IF EXISTS Skill;");
			stmt.execute("DROP TABLE IF EXISTS Message;");
			stmt.execute("DROP TABLE IF EXISTS Position;");
			stmt.execute("DROP TABLE IF EXISTS Experience;");
			//stmt.execute("DROP TABLE IF EXISTS ChallengePosition;");
			
			stmt.execute("DROP TABLE IF EXISTS Comment;");
			stmt.execute("DROP TABLE IF EXISTS DeveloperTrack;");
			stmt.execute("DROP TABLE IF EXISTS DeveloperChallenge;");
			stmt.execute("DROP TABLE IF EXISTS BadgeTrack;");
			stmt.execute("DROP TABLE IF EXISTS Badge;");
			stmt.execute("DROP TABLE IF EXISTS Submission;");
			stmt.execute("DROP TABLE IF EXISTS QuestionLanguage;");
			stmt.execute("DROP TABLE IF EXISTS Language;");
			stmt.execute("DROP TABLE IF EXISTS Question;");
			stmt.execute("DROP TABLE IF EXISTS Challenge;");

			stmt.execute("DROP TABLE IF EXISTS TrackTopic;");
			stmt.execute("DROP TABLE IF EXISTS Track;");
			stmt.execute("DROP TABLE IF EXISTS Topic;");
			
			stmt.execute("DROP TABLE IF EXISTS Developer;");
			stmt.execute("DROP TABLE IF EXISTS Company;");
			stmt.execute("DROP TABLE IF EXISTS User;");

			stmt.executeUpdate("CREATE TABLE User(user_id int PRIMARY KEY, "
													+ "username	varchar(40)	NOT NULL, "
													+ "user_name varchar(40)	NOT NULL, "
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

			stmt.executeUpdate("CREATE TABLE Skill( skill_id int PRIMARY KEY, "
													+ "skill_name varchar(40) NOT NULL) ENGINE = InnoDB;");
			
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
			
			stmt.executeUpdate("CREATE TABLE Message ( msg_id int PRIMARY KEY, "
													+ "text varchar(500) NOT NULL,"
													+ "msg_date TIMESTAMP,"
													+ "to_id int,"
													+ "from_id int,"
													+ "FOREIGN KEY (to_id) references User(user_id), "
													+ "FOREIGN KEY (from_id) references User(user_id))  ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE Position ( p_name varchar(30), "
													+ "user_id int, "
													+ "PRIMARY KEY (p_name, user_id), "
													+ "FOREIGN KEY (user_id) references Company(user_id)"
													+ "ON DELETE CASCADE) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE Language ( language_id int PRIMARY KEY,"
													+ "lang_name varchar(30) NOT NULL) ENGINE = InnoDB; ");
			
			stmt.executeUpdate("CREATE TABLE Topic (topic_id int PRIMARY KEY, "
													+ "topic_name varchar(40) NOT NULL) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE Track ( track_id int PRIMARY KEY, "
													+ "track_name varchar(40) NOT NULL, "
													+ "track_desc varchar(200)) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE TrackTopic (track_id int, topic_id int, "
													+ "PRIMARY KEY (track_id, topic_id), "
													+ "FOREIGN KEY (track_id) references Track(track_id), "
													+ "FOREIGN KEY (topic_id) references Topic(topic_id)) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE Challenge ( challenge_id int PRIMARY KEY, "
													+ "name	varchar(40), "
													+ "deadline date NOT NULL, "
													+ "topic_id int NOT NULL, "
													+ "is_active bit NOT NULL, "
													+ "FOREIGN KEY (topic_id)  REFERENCES Topic(topic_id)) ENGINE = InnoDB;");

			stmt.executeUpdate("CREATE TABLE DeveloperChallenge ( user_id int, "
													+ "challenge_id int, "
													+ "challenge_score int NOT NULL, "
													+ "PRIMARY KEY (user_id, challenge_id), "
													+ "FOREIGN KEY (user_id) REFERENCES Developer(user_id),"
													+ "FOREIGN KEY (challenge_id) REFERENCES Challenge(challenge_id)) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE Question (question_id int PRIMARY KEY, "
													+ "difficulty enum('easy', 'medium', 'hard') NOT NULL, "
													+ "challenge_id int NOT NULL, "
													+ "title varchar(50) NOT NULL, FOREIGN KEY (challenge_id) references Challenge(challenge_id) ) ENGINE = InnoDB;");
			
			/*stmt.executeUpdate("CREATE TABLE ChallengePosition ( challenge_id int, "
													+ "p_name varchar(30), "
													+ "user_id int, "
													+ "PRIMARY KEY (challenge_id, p_name, user_id),"
													+ "FOREIGN KEY (user_id) REFERENCES Company(user_id),"
													+ "FOREIGN KEY (challenge_id) REFERENCES Challenge(challenge_id),"
													+ "FOREIGN KEY (p_name, user_id) REFERENCES Position(p_name, user_id)) ENGINE = InnoDB;");*/

			stmt.executeUpdate("CREATE TABLE QuestionLanguage ( language_id	int,"
													+ "question_id int NOT NULL, "
													+ "PRIMARY KEY (language_id, question_id),"
													+ "FOREIGN KEY (language_id) REFERENCES Language(language_id),"
													+ "FOREIGN KEY (question_id) REFERENCES Question(question_id)) ENGINE = InnoDB;");

			stmt.executeUpdate("CREATE TABLE Submission ( sub_id int, "
													+ "sub_date timestamp NOT NULL, "
													+ "user_id int NOT NULL, "
													+ "question_id int NOT NULL, "
													+ "sub_score int NOT NULL,"
													+ "PRIMARY KEY (sub_id, user_id, question_id),"
													+ "FOREIGN KEY (user_id) REFERENCES User(user_id),"
													+ "FOREIGN KEY (question_id) REFERENCES Question(question_id)) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE Experience ( company_name varchar(40), "
													+ "start_date date, "
													+ "end_date date, "
													+ "user_id int, "
													+ "position varchar(40), "
													+ "PRIMARY KEY (company_name, start_date, end_date, position, user_id), "
													+ "FOREIGN KEY (user_id) REFERENCES Developer(user_id) "
													+ "ON DELETE CASCADE) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE Badge( badge_id int PRIMARY KEY, "
													+ "badge_name varchar(40) NOT NULL, "
													+ "user_id int NOT NULL, "
													+ "badge_desc varchar(200),"
													+ "FOREIGN KEY (user_id) REFERENCES Developer(user_id)) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE BadgeTrack ( badge_id int, "
													+ "track_id int, "
													+ "PRIMARY KEY (badge_id, track_id), "
													+ "FOREIGN KEY (badge_id) references Badge(badge_id), "
													+ "FOREIGN KEY (track_id) references Track(track_id)) ENGINE = InnoDB;");
			
			stmt.executeUpdate("CREATE TABLE DeveloperTrack ( user_id int, "
													+ "track_id int, "
													+ "track_score int NOT NULL, "
													+ "PRIMARY KEY (user_id, track_id), "
													+ "FOREIGN KEY (user_id) references Developer(user_id), "
													+ "FOREIGN KEY (track_id) references Track(track_id)) ENGINE = InnoDB;");

			stmt.executeUpdate("CREATE TABLE Comment ( com_id int PRIMARY KEY, "
													+ "text varchar(140) NOT NULL, "
													+ "date timestamp NOT NULL, "
													+ "reply_id int, "
													+ "user_id int, "
													+ "challenge_id int, "
													+ "FOREIGN KEY (reply_id) references Comment(com_id),"
													+ "FOREIGN KEY (user_id) references User(user_id),"
													+ "FOREIGN KEY (challenge_id) references Challenge(challenge_id)  ) ENGINE = InnoDB;");
			
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

}
