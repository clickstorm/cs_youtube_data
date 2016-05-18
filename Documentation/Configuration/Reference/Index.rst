.. include:: ../../Includes.txt

Reference
^^^^^^^^^



Constants
""""""""""

.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         view.templateRootPath
   
   Data type
         file
   
   Description
         Path to template root (FE)
   
   Default
         EXT:cs\_youtube\_data/Resources/Private/Templates/


.. container:: table-row

   Property
         view.layoutRootPath
   
   Data type
         file
   
   Description
         Path to template layouts (FE)
   
   Default
         EXT:cs\_youtube\_data/Resources/Private/Layouts/


.. container:: table-row

   Property
         view.partialRootPath
   
   Data type
         file
   
   Description
         Path to template partials (FE)
   
   Default
         EXT:cs\_youtube\_data/Resources/Private/Partials/


.. container:: table-row

   Property
         settings.videoUrlPart
   
   Data type
         String
   
   Description
         The part parameter (id, snippet, contentDetails, fileDetails, liveStreamingDetails, localizations, player, processingDetails, recordingDetails, statistics, status, suggestions, and topicDetails)
   
   Default
         id,snippet,contentDetails,statistics,recordingDetails,player


.. container:: table-row

   Property
         settings.videoPlayerWidth
   
   Data type
         intenger
   
   Description
         Width of the video in px
   
   Default
         560


.. container:: table-row

   Property
         settings.videoPlayerHeight
   
   Data type
         intenger
   
   Description
         Height of the video in px
   
   Default
         315


.. ###### END~OF~TABLE ######


Example
~~~~~~~

::

   page.includeCSS.tx_csyoutubedata = https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css
   plugin.tx_csyoutubedata.settings.videoPlayerWidth  = 560
   plugin.tx_csyoutubedata.settings.videoPlayerHeight  = 315
