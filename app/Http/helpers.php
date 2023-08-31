<?php



if(! function_exists('get_qamar_date'))
{
	/**
	* Fetches Qamar Date for Today
	* 
	* @return 
	*/
	function get_qamar_date()
	{
		$maintime = \App\Models\Maintime::where('greg_date', date('Y-m-d'))->first();

		if($maintime != null){
			return \Carbon\Carbon::createFromFormat('Y-m-d', $maintime->qamar_date);
		}
		return null;
	}


}