package com.tecsolvent.wizspeak.model;

/**
 * Created by gopu on 31/3/16.
 */
public class MentorFollow {
	private long id;
	private int user_id, mentor_id;
	private String status, date_updated;

	public MentorFollow(long id, int user_id, int mentor_id, String status) {

		this.id = id;
		this.user_id = user_id;
		this.mentor_id = mentor_id;
		this.status = status;

	}

	public MentorFollow() {

	}

	public long getId() {
		return id;
	}

	public void setId(long id) {
		this.id = id;
	}

	public int getUser_id(String user_id) {
		return this.user_id;
	}

	public void setUser_id(int user_id) {
		this.user_id = user_id;
	}

	public int getMentor_id(String mentor_id) {
		return this.mentor_id;
	}

	public void setMentor_id(int mentor_id) {
		this.mentor_id = mentor_id;
	}

	public String getStatus(String status) {
		return this.status;
	}

	public void setStatus(String status) {
		this.status = status;
	}

	public String getDate_updated() {
		return date_updated;
	}

	public void setDate_updated(String date_updated) {
		this.date_updated = date_updated;
	}


}
