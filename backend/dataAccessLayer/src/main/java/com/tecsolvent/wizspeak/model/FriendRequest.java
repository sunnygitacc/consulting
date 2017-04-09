package com.tecsolvent.wizspeak.model;

/**
 * Created by gopu on 31/3/16.
 */
public class FriendRequest {
	public int id;
	public int user_id_a;
	public int user_id_b;
	public int request_status;

	public FriendRequest(int id, int user_id_a, int user_id_b, int request_status) {
		this.id = id;
		this.user_id_a = user_id_a;
		this.user_id_a = user_id_b;
		this.user_id_a = request_status;
	}

	public FriendRequest() {

	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getUser_id_a(String user_id_a) {
		return this.user_id_a;
	}

	public void setUser_id_a(int user_id_a) {
		this.user_id_a = user_id_a;
	}

	public int getUser_id_b(String user_id_b) {
		return this.user_id_b;
	}

	public void setUser_id_b(int user_id_b) {
		this.user_id_b = user_id_b;
	}

	public int getRequest_status(String request_status) {
		return this.request_status;
	}

	public void setRequest_status(int request_status) {
		this.request_status = request_status;
	}

}
