package com.tecsolvent.wizspeak.service;

import com.tecsolvent.wizspeak.FriendDao;
import com.tecsolvent.wizspeak.GroupDao;
import com.tecsolvent.wizspeak.PostDao;
import com.tecsolvent.wizspeak.UserDao;
import com.tecsolvent.wizspeak.cache.GuavaAndCouchbaseCache;
import com.tecsolvent.wizspeak.model.Post;
import com.tecsolvent.wizspeak.model.User;
import org.apache.log4j.Logger;

import java.util.ArrayList;
import java.util.Iterator;

/**
 * Created by jaison on 23/3/16.
 */
public class PostService {


	private PostDao postDao;
	private GroupDao groupDao;
	private UserDao userDao;
	private FriendDao friendDao;



	private GuavaAndCouchbaseCache guavaAndCouchbaseCache;
	public static Logger logger = Logger.getLogger(PostService.class);

	public void setPostDao(PostDao postDao) {
		this.postDao = postDao;
	}

	public void setGroupDao(GroupDao groupDao) {
		this.groupDao = groupDao;
	}

	public void setUserDao(UserDao userDao) { this.userDao = userDao; }

	public void setGuavaAndCouchbaseCache(GuavaAndCouchbaseCache guavaAndCouchbaseCache) {
		this.guavaAndCouchbaseCache = guavaAndCouchbaseCache;
	}

	public void setFriendDao(FriendDao friendDao) {
		this.friendDao = friendDao;
	}

	public ArrayList<Post> getGroupWallPosts(long wallId, int wallType, int vertical, int postType){

		ArrayList<Post> groupPosts = new ArrayList<>();

		//connected groupids and same group
		ArrayList<Long> connectedGroup = new ArrayList<>();
		try {

			connectedGroup = groupDao.getConnectedGroups(wallId,1);
			connectedGroup.add(wallId);

		} catch (Exception e) {

			logger.info("error in getting connected groups "+e);
		}



		ArrayList<Post> newPosts = new ArrayList<>();
		ArrayList<Long> userIds = new ArrayList<>();
		try {
			groupPosts = postDao.getPosts(userIds,connectedGroup,0,postType);

			Iterator posts = groupPosts.iterator();
			while (posts.hasNext()){

				Post post = (Post) posts.next();
				User user = userDao.getUserName(post.getPostby_id());

				post.setPostby_name(user.getFirst_name()+" "+user.getLast_name());
				post.setPostby_pic(userDao.getUserPic(user.getId(),1,1));
				newPosts.add(post);
			}



		} catch (Exception e) {
			logger.info("error in user posts "+e);
		}


		return newPosts;

	}


	public ArrayList<Post> getHomePosts(int verticalId,long userId) throws Exception {


		//ambition home page - post from user,userfriend,userGroups
		ArrayList<Long> friendList =  friendDao.getUserFriends(userId);

		//add userid also
		friendList.add(userId);

		//user groups
		ArrayList<Long> groups =  groupDao.getUserGroupId(userId);

		// postType
		int postType = 0;//all posts

		ArrayList<Post> posts = new ArrayList<>();

		try {

			posts = postDao.getPosts(friendList,groups,0,postType);
		}catch (Exception e){

			logger.info("error in posts "+e);
		}


		return posts;

	}






}
