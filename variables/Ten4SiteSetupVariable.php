<?php
namespace Craft;

class Ten4SiteSetupVariable
{
	public function dbCharset()
	{
		return craft()->db->charset;
	}
}