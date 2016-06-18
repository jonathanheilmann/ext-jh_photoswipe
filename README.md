# TYPO3 CMS extension "jh_photoswipe"

**Extension key:**
jh_photoswipe

**Version:**
0.0.3

**Language:**
en

**Description:**
Adds the wonderful PhotoSwipe [photoswipe.com](http://photoswipe.com/) JavaScript gallery as a plugin to TYPO3 CMS.

**Keywords:**
gallery,photoswipe,lightbox

**Copyright:**
2014-2016

**Author:**
Jonathan Heilmann

**Email:**
[mail@jonathan-heilmann.de](mail@jonathan-heilmann.de)

**Licence:**
This document is published under the Open Publication License available from [opencontent.org/openpub/](http://www.opencontent.org/openpub/)

The content of this document is related to TYPO3, a GNU/GPL CMS/Framework available from www.typo3.org.


##Administration

###Installation

1. Go to the Extension Manager
2. Install the extension
3. Include the static template "PhotoSwipe (jh_photoswipe)"
4. Configure extension if required (see section below)


##Configuration

PhotoSwipe is configured by JavaScript inside a template. If you want to modify the default configuration, 
please copy the template to another location and update the "Path to template root" in Constant Editor.

By default, this extension includes a stable version of PhotoSwipe. If you want to link to a newer, 
older or modified version of PhotoSwipe, please use the Constant Editor to override paths.

Further settings applied in TypoScript setup:

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

##User

Add a PhotoSwipe content element to your site:

1. Create a new content element of type "plugin"
2. Select plugin "PhotoSwipe"
3. Add image(s) and configure gallery
4. Save

##How-to

###Adapt caption position to bottom

Add these lines to your template setup:
    
    plugin.tx_jhphotoswipe._CSS_DEFAULT_STYLE >
    plugin.tx_jhphotoswipe._CSS_DEFAULT_STYLE (
        caption {
            caption-side: bottom;
        }
        .cursor-pointer:hover {
            cursor: pointer;
        }
        
    )

##Known Problems

To check if there are known issues or planed features, please visit [github.com/jonathanheilmann/ext-jh_photoswipe/issues](https://github.com/jonathanheilmann/ext-jh_photoswipe/issues)

You are welcome to report issues and suggest enhancements/features, too.

##ChangeLog

###0.0.3

- [TASK] #12 Use templateRootPaths
- [TASK] #11 Remove ExtensionBuilder files
- [TASK] #10 Update photoswipe
- [TASK] #8 Remove unused TCA fields
- [ENHANCEMENT] #1 Add documentation

###0.0.2

- [TASK] #3 TYPO3 CMS 7 LTS compatibility
- [TASK] #4 Update copyright year to 2016
- [TASK] #5 Implement PSR-2 standard

###0.0.1

- Initial release of Extension
