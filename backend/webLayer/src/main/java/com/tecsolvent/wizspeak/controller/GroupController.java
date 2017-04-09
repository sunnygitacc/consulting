package com.tecsolvent.wizspeak.controller;

import com.tecsolvent.wizspeak.model.Group;
import com.tecsolvent.wizspeak.service.GroupService;
import com.tecsolvent.wizspeak.utility.JsonConvert;
import org.apache.log4j.Logger;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import javax.annotation.Resource;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.util.HashMap;
import java.util.Map;

/**
 * Created by jaison on 17/3/16.
 */
@Controller
public class GroupController {

	public static Logger logger = Logger.getLogger(AmbitionController.class);



	@Resource(name = "groupService")
	GroupService groupService;


	@RequestMapping(value = "/getGroupAbout/{groupCustomUrl}/{userId}",method = RequestMethod.GET)
	public
	@ResponseBody
	String getGroupAbout(@PathVariable String groupCustomUrl,@PathVariable long userId)throws Exception{

		Map<String,Object> group = groupService.getGroup(groupCustomUrl,userId);
		return JsonConvert.ObjJson(group);
	}



	@RequestMapping(value = "/getGroupWall/{groupCustomUrl}/{userId}",method = RequestMethod.GET)
	public
	@ResponseBody
	String getGroupWall(@PathVariable String groupCustomUrl,@PathVariable long userId) throws Exception{

		Map<String ,Object> group = groupService.getGroupWall(groupCustomUrl,userId);
		return JsonConvert.ObjJson(group);
	}

	@RequestMapping(value = "/getGroupMedia/{groupCustomUrl}/{userId}/{postType}",method = RequestMethod.GET)
	public
	@ResponseBody
	String getGroupMedia(@PathVariable String groupCustomUrl,@PathVariable long userId,@PathVariable int postType) throws Exception{

		Map<String ,Object> group = groupService.getGroupMedia(groupCustomUrl,userId,postType);
		return JsonConvert.ObjJson(group);
	}


	@RequestMapping(value = "/updatGroupName", method = RequestMethod.POST)
	public
	@ResponseBody
	String updatGroupName(HttpServletRequest request, HttpServletResponse response) throws Exception{
		logger.info("group name = "+request.getParameter("name"));

		Map<String,String> status = new HashMap<>();

		status.put("status","0");

		if(groupService.updateGroupName(request.getParameter("name"),Long.parseLong(request.getParameter("id")))){
			status.put("status","1");

		}

		return JsonConvert.ObjJson(status);
	}



	@RequestMapping(value = "/updateGroupDesciption", method = RequestMethod.POST)
	public
	@ResponseBody
	String updateGroupDesciption(HttpServletRequest request, HttpServletResponse response) throws Exception{
		logger.info("group name = "+request.getParameter("description"));

		Map<String,String> status = new HashMap<>();

		status.put("status","0");

		if(groupService.updateGroupDescription(request.getParameter("description"),Long.parseLong(request.getParameter("id")))){
			status.put("status","1");

		}

		return JsonConvert.ObjJson(status);
	}



}
