<?php
namespace Craft;

class Ten4SiteSetupPlugin extends BasePlugin
{
	function getName()
	{
		return Craft::t( 'Ten4 Site Setup' );
	}

	function getVersion()
	{
		return '1.0';
	}

	function getDeveloper()
	{
		return 'Ten4 Design Ltd';
	}

	function getDeveloperUrl()
	{
		return 'http://www.ten4design.co.uk/';
	}

	public function hasCpSection()
	{
		return true;
	}

}