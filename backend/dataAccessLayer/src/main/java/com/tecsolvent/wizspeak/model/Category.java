package com.tecsolvent.wizspeak.model;

/**
 * Created by jaison on 1/3/16.
 */
public class Category {

    private String name;
    private int verticalId,id;
    private int hasFans;
	private int type;

    public Category(int id, String name, int hasFans, int type) {
		this.id = id;
        this.name = name;
        this.hasFans = hasFans;
        this.type = type;
    }

    public Category() {
    }
//setters

	public void setId(int id) { this.id = id; }

	public void setName(String name) {
        this.name = name;
    }

    public void setVerticalId(int verticalId) {
        this.verticalId = verticalId;
    }

    public void setHasFans(int hasFans) {
        this.hasFans = hasFans;
    }

    public void setType(int type) {
        this.type = type;
    }



    // getters


    public String getName() {
        return name;
    }

    public int getVerticalId() {
        return verticalId;
    }

    public int isHasFans() {
        return hasFans;
    }

    public int isType() {
        return type;
    }

	public int getId() { return id; }
}
