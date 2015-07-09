<?php
namespace Craft;

class Ten4SiteSetupController extends BaseController
{

	public function actionCleanInstall()
	{
		try
		{
			// Delete all sections
			$all_section_ids = craft()->sections->getAllSectionIds();
			foreach( $all_section_ids as $id )
			{
				craft()->sections->deleteSectionById( $id );
			}

			// Delete all field groups
			$all_field_groups = craft()->fields->getAllGroups();
			foreach( $all_field_groups as $field_group )
			{
				craft()->fields->deleteGroupById( $field_group->id );
			}

			// Delete all tag groups
			$all_tag_groups = craft()->tags->getAllTagGroups();
			foreach( $all_tag_groups as $tag_group )
			{
				craft()->tags->deleteTagGroupById( $tag_group->id );
			}

			craft()->userSession->setNotice( 'All content removed!' );
		}
		catch( Exception $e )
		{
			craft()->userSession->setError( $e->getMessage() );
		}
	}

	public function actionAddSeoFields()
	{
		try
		{
			craft()->ten4SiteSetup->addSeoFields();
			craft()->userSession->setNotice( 'SEO fields + globals successfully installed!' );
		}
		catch( Exception $e )
		{
			craft()->userSession->setError( $e->getMessage() );
		}
	}

	public function actionCreateAssetsSource()
	{
		try
		{
			craft()->ten4SiteSetup->createAssetSource();
			craft()->userSession->setNotice( 'Asset source created!' );
		}
		catch( Exception $e )
		{
			craft()->userSession->setError( $e->getMessage() );
		}
	}

}