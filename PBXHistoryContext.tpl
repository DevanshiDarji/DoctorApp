{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
<div>
<div class='row-fluid'>
	<div class='span12'>
		<div class='span12'>
			<div class='row-fluid'>
				<div class='span3'>
					<b>Bellers in de wachtrij:</b>
				</div>
				<div class='span2'>
					<a href="index.php?module=PBXManager&parent=&page=1&view=List&viewname=189&orderby=&sortorder=&search_params=&search_key=customer&search_value=">{$details.ringingNoOfRows}</a>
				</div>
	        </div>
		</div>
		<hr>
		<div class='span12'>
			<div class='row-fluid'>
				<div class='span3'>
					<b>Aangemelde agent:</b>
				</div>
				<div class='span2'>
					<a href="index.php?module=PBXManager&parent=&page=1&view=List&viewname=189&orderby=&sortorder=&search_params=&search_key=customer&search_value=">{$details.ringingNoOfRows}</a>
				</div>
	        </div>
		</div>
		<hr>
		<div class='span12'>
			<div class='row-fluid'>
				<div class='span3'>
					<b>Actieve gesprekken:</b>
				</div>
				<div class='span2'>
					<a href="index.php?module=PBXManager&view=List&viewname=188">{$details.callinprocessNoOfRows}</a>
				</div>
	        </div>
		</div>
		<hr>
		<div class='span12'>
			<div class='row-fluid'>
				<div class='span3'>
					<b>Langste gesprek op dit moment:</b>
				</div>
				<div class='span2'>
					<a href="index.php?module=PBXManager&view=List&viewname=185">{($details.Maxduration/60)|round} (Mins)</a>
				</div>
	        </div>
		</div>
		<hr>
		<div class='span12'>
			<div class='row-fluid'>
				<div class='span3'>
					<b>Gesprekken vandaag:</b>
				</div>
				<div class='span2'>
					<a href="index.php?module=PBXManager&view=List&viewname=186">{$details.TodayNoOfRows}</a>
				</div>
	        </div>
		</div>
		<hr>
		<div class='span12'>
			<div class='row-fluid'>
				<div class='span3'>
					<b>Gesprekken gisteren:</b>
				</div>
				<div class='span2'>
					<a href="index.php?module=PBXManager&view=List&viewname=187">{$details.YesterdayNoOfRows}</a>
				</div>
	        </div>
		</div>
		<hr>
	</div>
</div>
</div>
