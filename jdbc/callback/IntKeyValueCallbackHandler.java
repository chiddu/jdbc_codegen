package com.aurospaces.neighbourhood.db.callback;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.Map;

import org.springframework.jdbc.core.RowCallbackHandler;

public class IntKeyValueCallbackHandler implements RowCallbackHandler
{
	Map<Integer,Integer>  retList;
	String keyColumn;
	String valueColumn;
	public IntKeyValueCallbackHandler(String keyColumn, String valueColumn)
	{
		this.keyColumn = keyColumn;
		this.valueColumn = valueColumn;
		retList = new HashMap<Integer,Integer>(); 
	}

	public Map<Integer,Integer> getResult()
	{
		return retList;
	}
	
	
	public void processRow(ResultSet rs) throws SQLException {
		int jobid  = rs.getInt(keyColumn);
		int locid  = rs.getInt(valueColumn);
		retList.put(jobid,locid);
	
	}
		

	
}
