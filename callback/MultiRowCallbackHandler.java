package com.aurospaces.neighbourhood.db.callback;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;

import org.springframework.jdbc.core.RowCallbackHandler;

public class MultiRowCallbackHandler implements RowCallbackHandler
{
	Map<String,List<Map<String,String>>> retList;
	String keyColumn;
	String[] columnsToQuery;

	public MultiRowCallbackHandler(String keyColumn, String[] columnsToQuery)
	{
		this.keyColumn = keyColumn;
		this.columnsToQuery = columnsToQuery;
		this.retList = new LinkedHashMap<String,List<Map<String,String>>>();
	}

	/* This is redundant, since we use an external Map,
	the result is already available to the caller */
	public Map<String,List<Map<String,String>>>  getResult()
	{
		return retList;
	}

public void processRow(ResultSet rs) throws SQLException 
{
	
	String value = rs.getString(keyColumn);
	List<Map<String,String>> eachRow  = retList.get(value);
	if(eachRow == null)
	{
		eachRow = new ArrayList<Map<String,String>>();
		retList.put(value,eachRow);
	}

	String keyValue = null;
	Map<String,String> results = new HashMap<String,String>();
	eachRow.add(results);
	for(String column : columnsToQuery)
	{
		String colvalue   = rs.getString(column);
		results.put(column, colvalue );
	}
}
	
}
