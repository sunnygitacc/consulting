package com.tecsolvent.wizspeak.model;

/**
 * Created by jaison on 23/2/16.
 */
public class User {

	private long id;
	private int city;
	private int state;
	private int country;
	private boolean mentor, activated;
	private String first_name, user_id_a, last_name, dob, email, profileStatus, profilePic, userId;
	public User() {
	}
	public User(int id) {

	}




	public User(long id, int city, int state, int country, String first_name, String last_name, String email, String userId, String dob) {
		this.id = id;
		this.city = city;
		this.state = state;
		this.country = country;
		this.first_name = first_name;
		this.last_name = last_name;
		this.email = email;
		this.userId = userId;
		this.dob = dob;


	}

	public User(long id, String first_name, String last_name) {
		this.id = id;
		this.first_name = first_name;
		this.last_name = last_name;
	}

	public User(long id, int city, int state, int country, boolean mentor, String first_name, String last_name, String dob, String email, String profileStatus) {
		this.id = id;
		this.city = city;
		this.state = state;
		this.country = country;
		this.mentor = mentor;
		this.activated = activated;
		this.first_name = first_name;
		this.last_name = last_name;
		this.dob = dob;
		this.email = email;
		this.profileStatus = profileStatus;
	}

	public User(long id, int city, int state, int country, boolean mentor, String first_name, String last_name, String dob, String email, String profileStatus, String profilePic) {
		this.id = id;
		this.city = city;
		this.state = state;
		this.country = country;
		this.mentor = mentor;
		this.first_name = first_name;
		this.last_name = last_name;
		this.dob = dob;
		this.email = email;
		this.profileStatus = profileStatus;
		this.profilePic = profilePic;
	}

	public User(String user_id_a) {
	}

	public String getUser_id_a() {
		return user_id_a;
	}

	public void setUser_id_a(String user_id_a) {
		this.user_id_a = user_id_a;
	}

	public String getUserId() {
		return userId;
	}

	public void setUserId(String userId) {
		this.userId = userId;
	}

	public long getId() {
		return id;

	}

	//setters
	public void setId(long id) {
		this.id = id;
	}

	public void setMentor(boolean mentor) {
		this.mentor = mentor;
	}

	public void setActivated(boolean activated) {
		this.activated = activated;
	}

	public String getProfilePic() {
		return profilePic;
	}

	public void setProfilePic(String profilePic) {
		this.profilePic = profilePic;
	}

	public int getCity() {

		return city;
	}

	public void setCity(int city) {
		this.city = city;
	}

	public int getState() {
		return state;
	}

	public void setState(int state) {
		this.state = state;
	}

	public int getCountry() {
		return country;
	}

	public void setCountry(int country) {
		this.country = country;
	}

	public boolean mentor() {
		return mentor;
	}
	//getter

	public String getFirst_name() {
		return first_name;
	}

	public void setFirst_name(String first_name) {
		this.first_name = first_name;
	}

	public String getLast_name() {
		return last_name;
	}

	public void setLast_name(String last_name) {
		this.last_name = last_name;
	}

	public String getDob() {
		return dob;
	}

	public void setDob(String dob) {
		this.dob = dob;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getProfileStatus() {
		return profileStatus;
	}

	public void setProfileStatus(String profileStatus) {
		this.profileStatus = profileStatus;
	}


}
