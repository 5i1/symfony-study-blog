# Routes API

This document contains all API definitions and their routes.

**Add media file**
----
      
* **URL**

    /api/media/upload

* **Method:**

    `POST`
  
* **URL Params**

    None

* **Data Params**

    **Required:**

    `file=[file]`
    
    `token=[string]`

    **Optional:**
    
    `folderId=[integer]`

* **Success Response:**

  * **Code:** 200  
    **Content:** 
    
    ```bash
    {
         "success": true, 
         "message": "Upload successfully",
         "media": "uploads/media/2019/08/image.jpeg",
         "errors": []
     }
    ```


**Delete media file**
----
      
* **URL**

    /api/media/delete

* **Method:**

    `DELETE`
  
* **URL Params**

    None

* **Data Params**

    **Required:**
    
    `mediaId=[integer]`
    
    `token=[string]`

    **Optional:**
    
    None

* **Success Response:**

  * **Code:** 200  
    **Content:** 
    
    ```bash
    {
         "success": true, 
         "message": "Delete successfully"
     }
    ```


**Add folder**
----
      
* **URL**

    /api/folder

* **Method:**

    `POST`
  
* **URL Params**

    None

* **Data Params**

    **Required:**
    
    `name=[string]`
    
    `token=[string]`

    **Optional:**
    
    `parentId=[integer]`

* **Success Response:**

  * **Code:** 200  
    **Content:** 
    
    ```bash
    {
         "success": true, 
         "message": "Folder created successfully",
         "folder": {
            "id": 1,
            "name": "Name Folder"
         }
     }
    ```