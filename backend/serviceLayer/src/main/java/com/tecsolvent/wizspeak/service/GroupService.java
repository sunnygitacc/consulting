package com.tecsolvent.wizspeak.service;


import com.tecsolvent.wizspeak.GroupDao;
import com.tecsolvent.wizspeak.UserDao;
import com.tecsolvent.wizspeak.cache.GuavaAndCouchbaseCache;
import com.tecsolvent.wizspeak.model.Group;
import com.tecsolvent.wizspeak.model.GroupUser;
import com.tecsolvent.wizspeak.model.Post;
import com.tecsolvent.wizspeak.model.User;
import com.tecsolvent.wizspeak.utility.DateUtil;
import com.tecsolvent.wizspeak.utility.StringUtil;
import org.apache.log4j.Logger;



import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;

/**
 * Created by jaison on 13/3/16.
 */


public class GroupService  {

	private GroupDao groupDao;
	private UserDao userDao;
	private FriendService friendService;
	private MentorService mentorService;
	private PostService postService;



	private GuavaAndCouchbaseCache guavaAndCouchbaseCache;
	public static Logger logger = Logger.getLogger(GroupService.class);


	public void setGroupDao(GroupDao groupDao){ this.groupDao = groupDao; }

	public void setUserDao(UserDao userDao) {
		this.userDao = userDao;
	}

	public void setMentorService(MentorService mentorService) {
		this.mentorService = mentorService;
	}

	public void setGuavaAndCouchbaseCache(GuavaAndCouchbaseCache guavaAndCouchbaseCache) {
		this.guavaAndCouchbaseCache = guavaAndCouchbaseCache;
	}

	public void setPostService(PostService postService) {
		this.postService = postService;
	}

	public void setFriendService(FriendService friendService) {
		this.friendService = friendService;
	}


	public Map<String,Object>  getGroup(String groupCustomUrl, long userId)throws Exception {

		logger.info("inside get group service");

		long groupId = 0;

		//get groupId
		try {
			groupId = userDao.getWallId(groupCustomUrl,2);
		}catch (Exception e){

			logger.info("error in fectching group id "+e);
			throw e;
		}

		Map<String,Object> jsonData = new HashMap<>();

		jsonData = getGropPageBasics(jsonData,userId,groupId);

		//getgroup members
		logger.info("getting members");
		ArrayList<GroupUser> groupMembers =  getGroupMembers(groupId,1);

		jsonData.put("groupMembers",groupMembers);

		//group join requests
		logger.info("getting members");
		ArrayList<GroupUser> groupMembersReq =  getGroupMembers(groupId,4);

		jsonData.put("groupMemberRequest",groupMembersReq);

		//get connected groups
		logger.info("getting connected groups");

		ArrayList<Group> connectedGroup = new ArrayList<>();

		try{
			connectedGroup = getConnectedGroups(groupId);

		}catch (Exception e){

		logger.info(" error in getting connected groups "+e);
		}

		jsonData.put("connectedGroups",connectedGroup);


		return jsonData;
	}


	public Map<String,Object>getGroupWall(String groupCustomName,Long userId)throws Exception{

		long groupId = 0;
		//get groupId
		try {
			groupId = userDao.getWallId(groupCustomName,2);
		}catch (Exception e){

			logger.info("error in fectching group id "+e);
			throw e;
		}

		Map<String,Object> jsonData = new HashMap<>();

		jsonData = getGropPageBasics(jsonData,userId,groupId);

		//get group posts
		Group groupDetail  = (Group) jsonData.get("groupDetail");
		logger.info("get vertical id "+groupDetail.getVertical_id());

		try{
			ArrayList<Post> posts = postService.getGroupWallPosts(groupId,2,groupDetail.getVertical_id(),0);
			jsonData.put("groupPosts",posts);
		}catch (Exception e){

			logger.info("erro in getting group posts "+e);
		}

		return jsonData;
	}



	public Map<String,Object>getGroupMedia(String groupCustomName,Long userId,int mediaType)throws Exception{

		long groupId = 0;
		//get groupId
		try {
			groupId = userDao.getWallId(groupCustomName,2);
		}catch (Exception e){

			logger.info("error in fectching group id "+e);
			throw e;
		}

		Map<String,Object> jsonData = new HashMap<>();

		jsonData = getGropPageBasics(jsonData,userId,groupId);

		//get group posts images

		Group groupDetail  = (Group) jsonData.get("groupDetail");
		logger.info("get vertical id "+groupDetail.getVertical_id());

		try{
			ArrayList<Post> posts = postService.getGroupWallPosts(groupId,2,groupDetail.getVertical_id(),mediaType);
			jsonData.put("groupPosts",posts);
		}catch (Exception e){

			logger.info("erro in getting group posts "+e);
		}

		return jsonData;
	}



	public Map<String,Object> getGropPageBasics(Map<String,Object> jsonData,Long userId,Long groupId)throws Exception{

		//get user groups

		try {

			ArrayList<Group> userGroups = groupDao.getUserAmbitionGroups(userId);
			jsonData.put("userGroup",userGroups);

		}catch (Exception e){

			logger.info("error in fetching userGroups "+e);
		}

		//get user friends
		ArrayList<User> friends = new ArrayList<>();
		try {

			friends = friendService.getUserFriends(userId);

		}catch (Exception e){

			logger.info("error in fetching friends "+e);
		}

		jsonData.put("frindList",friends);

		//get mentor list

		ArrayList<User> mentors = new ArrayList<>();

		try {
			mentors = mentorService.getUserMentors(userId);

		}catch (Exception e){

			logger.info("errro in getting mentor list "+e);
		}
		jsonData.put("mentorList",mentors);

		//check user role


		ArrayList userGroups = new ArrayList();
		try{
			userGroups = getUserGroups(userId);
		}catch (Exception e){
			logger.info("exc "+e);
			throw e;
		}


		jsonData.put("userGroups",userGroups);

		//get group details
		Group group = getGroupDetails(groupId);
		jsonData.put("groupDetail",group);

		return jsonData;
	}



	public ArrayList<User> getUserFriends(long userId){
		ArrayList<User> userArrayList = new ArrayList<>();

		return userArrayList;
	}



	public ArrayList getUserGroups(long user_id) throws Exception {

		//get ambition groups

		ArrayList groups = (ArrayList) guavaAndCouchbaseCache.getObjectFromCache("userGroupswdd"+user_id,ArrayList.class);

		if(groups!=null){
			//System.out.println("from Group cache  ");
			return groups;
		}

		logger.info("fetching from mysql direct");

		ArrayList<Group> group = groupDao.getUserAmbitionGroups(user_id);

		Iterator<Group> itr = group.iterator();

		ArrayList<Group> aGroups = new ArrayList<Group>();
		ArrayList<Group> hGroups = new ArrayList<Group>();
		ArrayList<Group> tGroups = new ArrayList<Group>();

		while (itr.hasNext()){


			Group groupz = itr.next();

			//get group custom name
			String url = new String();
			try{
				url = userDao.getCustomUrl(groupz.getId(),2);

			}catch (Exception e){

				logger.info("error in fetching group custom url");

			}

			logger.error("url is empty"+url+" type is "+url.isEmpty());

			if(url.isEmpty()){
				logger.info("adding custom url");
				// add custom url

				if(addCustomGroupName(groupz.getName(),groupz.getId(),2,1)){

					logger.info("new custom url created ");

					url = userDao.getCustomUrl(groupz.getId(),2);

				}

			}


			groupz.setCustomUrl(url);


			logger.info("group id s "+groupz.getVertical_id());
			if(groupz.getVertical_id()==1){

				aGroups.add(groupz);
			}
			if(groupz.getVertical_id()==2){

				hGroups.add(groupz);
			}
			if(groupz.getVertical_id()==4){

				tGroups.add(groupz);
			}

		}

		ArrayList allGroups = new ArrayList();

		try {
			allGroups.add(aGroups);
			allGroups.add(hGroups);
			allGroups.add(tGroups);
		}catch (Exception E){
			//System.out.println("AmbitionService  service 129 ");
		}

		guavaAndCouchbaseCache.putObjectAsByteInCache("userGroupsw"+user_id, allGroups);

		return allGroups;

	}


	public boolean addCustomGroupName(String groupName,Long groupId,int wallType,int status) throws Exception{

		//Add custom url for group
		String customName = StringUtil.getGroupCustomName(groupName);

		logger.info("new custom name "+customName);

		Map<String,Object> url = new HashMap<>();
		url.put("name",customName);
		url.put("wall_id",groupId);
		url.put("wall_type",wallType);
		url.put("status",status);
		url.put("date_created", DateUtil.getDate());

		boolean result = false;

		try {
			userDao.addCustomUrl(url);
			result = true;
		}catch (Exception e){
			logger.info("error in adding custom url "+e);
			throw e;
		}

		return result;
	}

	public Group getGroupDetails(long groupId)throws Exception{

		Group group = new Group();
		try {
			group = groupDao.getGroup(groupId);
		}catch (Exception e){

			logger.info("error fecthing group basics "+e);
		}

		group.setProfilePic(getGroupPic(groupId,1));
		group.setCoverPic(getGroupPic(groupId,2));

		return group;
	}


	public String getGroupPic(long groupId,int picType) throws Exception {

		String profilePic = (String) guavaAndCouchbaseCache.getObjectFromCache("groupProfilePic"+groupId,String.class);
		if(profilePic == null){
			logger.info(" status fetching from mysql direct");
			profilePic = userDao.getUserPic(groupId,2,picType);
			if(profilePic == null){ profilePic=" ";}
			guavaAndCouchbaseCache.putObjectAsByteInCache("groupProfilePic"+groupId, profilePic);
		}else{

			logger.info("feching from cache");
		}

		return profilePic;
	}



	public ArrayList<GroupUser> getGroupMembers(long groupId,int status) throws Exception{

		ArrayList<GroupUser> members = new ArrayList<>();

		try {
			// 1- for members ,4-requested,5- invited
			members = groupDao.getGroupMembers(groupId,status);
			logger.info("getting members list "+groupId);
		}catch (Exception e){

			logger.info("error in getting group members");
		}

		Iterator memberItr = members.iterator();
		ArrayList<GroupUser> groupMembers = new ArrayList<>();
		while (memberItr.hasNext()){

			GroupUser groupUser = (GroupUser) memberItr.next();

			long userId = groupUser.getUser_id();
			logger.info("in loop"+userId);
			User user = userDao.getUserName(userId);
			userDao.getUserPic(userId,1,1);

			groupUser.setName(user.getFirst_name()+" "+user.getLast_name());
			groupUser.setUserPic(user.getProfilePic());

			groupMembers.add(groupUser);
		}

		return groupMembers;
	}


	public ArrayList<Group> getConnectedGroups(long groupId) throws Exception{

		ArrayList<Group> connectedGroups = new ArrayList<>();

		try{
			// 1 - connected  0 -requetsted
			ArrayList<Long> groupIds = groupDao.getConnectedGroups(groupId,1);

			Iterator group = groupIds.iterator();
			while (group.hasNext()){

				long gId = (long) group.next();

				connectedGroups.add(groupDao.getGroup(gId));

			}

		}catch (Exception e){
			logger.info("error in getting connected groupId "+e);
		}

		return connectedGroups;
	}


	public boolean updateGroupName(String name,long id) throws Exception{

		return  groupDao.updateGroupName(name,id);

	}


	public boolean updateGroupDescription(String description,long id) throws Exception{

		logger.info(" inside service ");

		return  groupDao.updateGroupDescription(description,id);

	}


}
