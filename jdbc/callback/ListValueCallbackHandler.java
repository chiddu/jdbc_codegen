package com.aurospaces.neighbourhood.db.callback;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.jdbc.core.RowCallbackHandler;

public class ListValueCallbackHandler implements RowCallbackHandler
{
	Map<String,List<String>>  retList;
	String keyColumn;
	String valueColumn;
	public ListValueCallbackHandler(String keyColumn, String valueColumn)
	{
		this.keyColumn = keyColumn;
		this.valueColumn = valueColumn;
		retList = new HashMap<String,List<String>>(); 
	}
	

	public Map<String,List<String>> getResult()
	{
		return retList;
	}


	public void processRow(ResultSet rs) throws SQLException {
		String jobid  = rs.getString(keyColumn);
		String locid  = rs.getString(valueColumn);
		List<String>  locids =  (List<String>)retList.get(jobid);
		if(locids == null)
		{
			locids =  new ArrayList<String>();
			retList.put(jobid,locids);
		}
		locids.add(locid);
	}
		

	
}
// GenericDao
