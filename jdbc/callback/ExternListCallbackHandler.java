package com.aurospaces.neighbourhood.db.callback;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;

import org.springframework.jdbc.core.RowCallbackHandler;

public class ExternListCallbackHandler implements RowCallbackHandler
{
	Map<String,Map<String,Object>>  retList;
	String keyColumn;
	String[] columnsToQuery;

	public ExternListCallbackHandler(String keyColumn, 
		String[] columnsToQuery,
		Map<String,Map<String,Object>>  retList
		)
	{
		this.keyColumn = keyColumn;
		this.columnsToQuery = columnsToQuery;
		this.retList = retList;
		/* We just append to this external list */
	}

	/* This is redundant, since we use an external Map,
	the result is already available to the caller */
	public Map<String,Map<String,Object>>  getResult()
	{
		return retList;
	}

public void processRow(ResultSet rs) throws SQLException 
{
	
	String value = rs.getString(keyColumn);
	Map<String,Object> eachRow =retList.get(value);
	if(eachRow == null)
	{
		eachRow = new HashMap<String,Object>();
		retList.put(value,eachRow);
	}

	String keyValue = null;
	for(String column : columnsToQuery)
	{
		value  = rs.getString(column);
		List<String> list = (List<String>)eachRow.get(column);
		if(list == null)
		{
			list = new ArrayList<String>();
			eachRow.put(column,list);
		}
		list.add(value);
	}
}
	
}
