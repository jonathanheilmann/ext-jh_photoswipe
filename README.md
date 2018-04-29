# TYPO3 CMS extension "jh_photoswipe"

**Extension key:**
jh_photoswipe

**Version:**
0.1.0

**Language:**
en

**Description:**
Adds the wonderful PhotoSwipe [photoswipe.com](http://photoswipe.com/) JavaScript gallery as a plugin to TYPO3 CMS.

**Keywords:**
gallery,photoswipe,lightbox

**Copyright:**
2014-2018 

**Author:**
Jonathan Heilmann

**Email:**
[mail@jonathan-heilmann.de](mail@jonathan-heilmann.de)

**Licence:**
This document is published under the Open Publication License available from [opencontent.org/openpub/](http://www.opencontent.org/openpub/)

The content of this document is related to TYPO3, a GNU/GPL CMS/Framework available from www.typo3.org.


## Administration

### Installation

1. Go to the Extension Manager
2. Install the extension
3. Include the static template "PhotoSwipe (jh_photoswipe)"
4. Configure extension if required (see section below)


## Configuration

PhotoSwipe is configured by JavaScript inside a template. If you want to modify the default configuration, 
please copy the template to another location and update the "Path to template root" in Constant Editor.

By default, this extension includes a stable version of PhotoSwipe. If you want to link to a newer, 
older or modified version of PhotoSwipe, please use the Constant Editor to override paths.

Further settings applied in TypoScript setup:

```
    plugin.tx_jhphotoswipe {
        settings {
            width = {$styles.content.imgtext.linkWrap.width}
            renderMsrc = 1
            msrcWidth = 265m
            photoswipeOptions = TEXT
            photoswipeOptions.value (
                galleryUID: {field:uid}
            )
            photoswipeOptions.stdWrap.insertData = 1
    
            files {
                photoswipeUiJs = {$plugin.tx_jhphotoswipe.includePhotoswipeUiJs}
                photoswipeJs = {$plugin.tx_jhphotoswipe.includePhotoswipeJs}
                openGalleryJs = {$plugin.tx_jhphotoswipe.includeOpenGalleryJs}
    
                photoswipeCss = {$plugin.tx_jhphotoswipe.includePhotoswipeCss}
                photoswipeDefaultskin = {$plugin.tx_jhphotoswipe.includePhotoswipeDefaultskin}
            }
        }
    }
    page.footerData {
        8410 = FLUIDTEMPLATE
        8410 {
            file = {$plugin.tx_jhphotoswipe.view.templateRootPath}pswpLayout.min.html
        }
    }
    
    plugin.tx_jhphotoswipe._CSS_DEFAULT_STYLE (
        .cursor-pointer:hover {
            cursor: pointer;
        }
    )
```

## User

Add a PhotoSwipe content element to your site:

1. Create a new content element of type "plugin"
2. Select plugin "PhotoSwipe"
3. Select mode "Single thumbnail" or "Multi thumbnail"
4. Add image(s) and configure gallery
5. Save

**Note**

In multi-thumbnail mode, not all gallery configurations are respected within the shipped **bootstrap_package** template.
A solution is scheduled for version 0.2.0 (https://github.com/jonathanheilmann/ext-jh_photoswipe/issues/24).

Not respected gallery configurations:

- Position (preview_orient)
- No rows (image_noRows)
- Imageborder (imageborder)
- Position if imagecaption (imagecaption_position) (See next section for solution)

## How-to

### Adapt caption position to bottom

Add these lines to your template setup:

```
    plugin.tx_jhphotoswipe._CSS_DEFAULT_STYLE >
    plugin.tx_jhphotoswipe._CSS_DEFAULT_STYLE (
        caption {
            caption-side: bottom;
        }
        .cursor-pointer:hover {
            cursor: pointer;
        }
        
    )
```

## Developer

### Signal Slots

| Signal Class Name	| Signal Name | Located in Method | Passed arguments | Description |
| --- | --- | ---- | --- | --- | --- |
| Heilmann\JhPhotoswipe\Controller\Pi1Controller | afterShowAction | showAction() | &$viewAssign, $this | Slot is called before $viewAssign is assigned to view via $this->view->multiAssign() and thus the action is finished |
| Heilmann\JhPhotoswipe\Controller\Pi1Controller | afterMultiThumbnailAction | multiThumbnailAction() | &$viewAssign, $this | Slot is called before $viewAssign is assigned to view via $this->view->multiAssign() and thus the action is finished |


## Known Problems

To check if there are known issues or planed features, please visit [github.com/jonathanheilmann/ext-jh_photoswipe/issues](https://github.com/jonathanheilmann/ext-jh_photoswipe/issues)

You are welcome to report issues and suggest enhancements/features, too.

## Breaking changes

### 0.1.0
**Template**

The structure of the whole template has been changed to reach better flexibility and minimize breaking changes in later versions.
Please review the files in Resources/Private/.

Version 0.1.0 supports the frontend theme extensions "bootstap_package" and "css_styled_content".
To offer a way to use custom frontend theme extensions, a fallback to partial "Custom.html" is used. The default custom templates displays a warning.
To solve this, override the partials path in ConstantEditor and add file "Show/Custom.html" for single-thumbnail mode and/or file "MultiThumbnail/Custom.html" for multi-thumbnail mode.

**Resources**

Before version 0.1.0, all Javascript and CSS files has been included to every page.
Since version 0.1.0, resources are included on pages where required. This should enhance performance of your website.


## ChangeLog

### 0.1.0

- [FEATURE] #16 Add multi-thumbnail mode
- [ENHANCEMENT] #15 Move JavaScript to footer
- [ENHANCEMENT] #17 Add multilingual support
- [ENHANCEMENT] #18 Enhance loading if CSS and JavaScript
- [ENHANCEMENT] #20 Add CE Wizard
- [ENHANCEMENT] #22 Add signals in controller
- [BUGFIX] #21 Fatal error in TYPO3 CMS 6.2
- [TASK] #25 Update Copyright to year 2017

### 0.0.3

- [TASK] #12 Use templateRootPaths
- [TASK] #11 Remove ExtensionBuilder files
- [TASK] #10 Update photoswipe
- [TASK] #8 Remove unused TCA fields
- [ENHANCEMENT] #1 Add documentation

### 0.0.2

- [TASK] #3 TYPO3 CMS 7 LTS compatibility
- [TASK] #4 Update copyright year to 2016
- [TASK] #5 Implement PSR-2 standard

### 0.0.1

- Initial release of Extension
