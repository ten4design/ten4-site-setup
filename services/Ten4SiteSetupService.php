<?php
namespace Craft;

class Ten4SiteSetupService extends BaseApplicationComponent
{

	public function addSeoFields()
	{
		$group = new FieldGroupModel();
		$group->name = 'SEO';

		if( !craft()->fields->saveGroup( $group ) )
		{
			throw new Exception( 'Failed to create SEO field group.' );
		}

		$field_description = new FieldModel();
		$field_description->groupId = $group->id;
		$field_description->name = 'SEO Description';
		$field_description->instructions = 'Enter a description here to override the default description.';
		$field_description->handle = 'seoDescription';
		$field_description->type = 'PlainText';

		if( !craft()->fields->saveField( $field_description ) )
		{
			throw new Exception( 'Failed to create SEO fields.' );
		}

		$global_field_layout_field = new FieldLayoutFieldModel();
		$global_field_layout_field->fieldId = $field_description->id;
		$global_field_layout_field->required = true;
		$global_field_layout_field->sortOrder = 1;

		$global_tab = new FieldLayoutTabModel();
		$global_tab->name = 'Content';
		$global_tab->sortOrder = 1;
		$global_tab->setFields( array(
			$global_field_layout_field
		) );

		$global_layout = new FieldLayoutModel();
		$global_layout->type = ElementType::GlobalSet;
		$global_layout->setTabs( array(
			$global_tab
		) );
		$global_layout->setFields( array(
			$global_field_layout_field
		) );

		if( !craft()->fields->saveLayout( $global_layout ) )
		{
			throw new Exception( 'Failed to create SEO global field layout.' );
		}

		$global_set = new GlobalSetModel();
		$global_set->name = 'SEO';
		$global_set->handle = 'seo';
		$global_set->setFieldLayout( $global_layout );

		if( craft()->globals->saveSet( $global_set ) )
		{
			return true;
		}
		else
		{
			throw new Exception( 'Failed to create SEO global set.' );
		}
	}

	public function createAssetSource()
	{
		$group = new FieldGroupModel();
		$group->name = 'Assets';

		if( !craft()->fields->saveGroup( $group ) )
		{
			throw new Exception( 'Failed to create assets field group.' );
		}

		$field_alt_text = new FieldModel();
		$field_alt_text->groupId = $group->id;
		$field_alt_text->name = 'Alt Text';
		$field_alt_text->instructions = 'Describe the image in words to assist visually-impaired users.';
		$field_alt_text->handle = 'altText';
		$field_alt_text->type = 'PlainText';

		if( !craft()->fields->saveField( $field_alt_text ) )
		{
			throw new Exception( 'Failed to create alt-text field.' );
		}

		$alt_text_field_layout_field = new FieldLayoutFieldModel();
		$alt_text_field_layout_field->fieldId = $field_alt_text->id;
		$alt_text_field_layout_field->required = false;
		$alt_text_field_layout_field->sortOrder = 1;

		$alt_text_tab = new FieldLayoutTabModel();
		$alt_text_tab->name = 'Content';
		$alt_text_tab->sortOrder = 1;
		$alt_text_tab->setFields( array(
			$alt_text_field_layout_field
		) );

		$alt_text_layout = new FieldLayoutModel();
		$alt_text_layout->type = ElementType::Asset;
		$alt_text_layout->setTabs( array(
			$alt_text_tab
		) );
		$alt_text_layout->setFields( array(
			$alt_text_field_layout_field
		) );

		if( !craft()->fields->saveLayout( $alt_text_layout ) )
		{
			throw new Exception( 'Failed to create alt-text field layout.' );
		}

		$source = new AssetSourceModel();
		$source->name = 'Images';
		$source->handle = 'images';
		$source->settings = array(
			'path' => '{fileSystemPath}uploads/images/',
			'url' => '{siteUrl}uploads/images/'
		);
		$source->setFieldLayout( $alt_text_layout );

		if( !craft()->assetSources->saveSource( $source ) )
		{
			throw new Exception( 'Failed to create asset source.' );
		}
	}

}