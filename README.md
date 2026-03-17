# COMP1103 Project Repo

It is your responsibility to read through this assignment content. Explanations of the process have been covered Module 1. If you need clarification, you must seek guidance early. 

This repository contains all the required information for the COMP1103 major project assignments. This repository will be used for the following assessments:
| Part | Repo Location | Weighting | Due Date |
| --- | :--- | :---: | :--- |
| Report: UX Design Report | [src/a1/](src/a1/) | 30% | End of Module 6 |
| Artefact Creation: Website Solution | [src/a2/](src/a2/) | 30% | End of Module 10 |
| Report: UX Evaluation | [src/a3/](src/a3/) | 20% | End of Module 12 |

The use of this repository is intended to emulate real world development processes. You will be required to effectively use git commands to add your work to the repo.

> [!CAUTION]
> As soon as you are uncertain, you should seek help from the teaching staff to understand your role and the requirements for the contribution process.

## Contents of the Project repo

The project repo is the location where all of your content for the assignment will be stored.  You will place all assessable work in the `src` folder. You will use git to maintain version control of your development. The project repo contains the following directories:

```
COMP1103-repo
├── .devcontainer
├── .github
├── project-docs
|  └── drafts
├── src
|  ├── a1
|  |  ├── data
|  |  └── imgs
|  ├── a2
|  |  ├── inc
|  |  └── sql-exports
|  ├── a3
|  |  ├── data
|  |  └── imgs
|  └── index.php
└── README.md
```


- **.devcontainer**: _!! no actions needed in this directory !!_. The directory is for the setup of the Codespaces devcontainer. Any modification of this directory and the files within could cause complications in setting up your cloud-based environment.
- **.github**: pull request template
- **project-docs**: location for project management documents
  - **drafts**: any temporary, early versions, or cut pieces of content from part 1 and part 3 should be stored here - use suitable directory structures
- **src**: location for all final assignment work. 
  - **a1**: directory where you will upload your FINAL project work for Report: UX Design Report.
    - _data_: store any observation, survey, user specific data, etc., within this directory.
    - _imgs_: store an images that are relevant and included in your report.
    - ***a1.md***: you will draft your report in this file.
  - **a2**: This is the directory where your website will be deployed from. You will need to create a suitable folder structure for the website (e.g., a folder for styles, a folder for scripts, etc.).
    - **inc**: directory containing the includes files for database connection
    - **sql-exports**: directory where you will save your dumps of your built and active database before assignment submission.
  - **a3**: directory where you will upload your FINAL project work for Report: UX Evaluation.
    - _data_: store any observation, survey, user specific data, etc., within this directory.
    - _imgs_: store an images that are relevant and included in your report.
    - ***a3.md***: you will draft your report in this file.

## Adding content to the project

For any inclusion in the project repo, you **MUST** follow the steps below:

1. Ensure your version of the `main` branch is up to date
1. Create a new branch for your addition
2. Edit your addition
3. Commit and push your branch
4. Submit a pull request
5. Open the pull request to review your submission and merge your changes.

_Instructions for this process have been covered in the first module of the topic._

While a real world scenario would have someone else conduct a code review of your pull request, we are still using the same sequence of steps to build up your skills.

## Submitting your work

For each assignment, you will need to zip your repo and submit the whole zip file to the submission box on FLO.  So for assignment 1, there will only be content in the `src/a1/` directory.  For assignment 2, you will have your previous work in `src/a1/` as well as the new content for your website in `src/a2/`.