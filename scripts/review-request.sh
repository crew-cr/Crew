#! /bin/bash

SCRIPT_NAME="Review request"
SCRIPT_VERSION="0.2"
SCRIPT_SHORT_DESC="simple script to request a review with Crew (http://pmsipilot.github.com/Crew)"
CUR_DIR=`pwd`

if [ ! -d "$CUR_DIR/.git" ]; then
  echo "You're not in the git working tree root."
  exit 1
fi

CREW_PROJECT_ID=1
BRANCH_TO_REVIEW=`git branch --no-color 2> /dev/null | sed -e '/^[^*]/d' -e 's/* \(.*\)/\1/'`
CREW_SERVER=http://crew

function usage {
  echo "$SCRIPT_NAME ($SCRIPT_VERSION), $SCRIPT_SHORT_DESC."
  echo "-b <branch to review> (default: $BRANCH_TO_REVIEW)"
  echo "-p <crew project id> (default: $CREW_PROJECT_ID)"
  echo "-s <crew server url> (default: $CREW_SERVER)"
  echo "-h : this help"
  echo "-v : version of $SCRIPT_NAME"
  exit 0
}

while getopts ":s:p:b:hv" opt; do
  case $opt in
    h)
      usage
      ;;
    v)
      echo "$SCRIPT_VERSION"
      exit 1
      ;;
    s)
      CREW_SERVER=$OPTARG
      ;;
    p)
      CREW_PROJECT_ID=$OPTARG
      ;;
    b)
      BRANCH_TO_REVIEW=$OPTARG
      ;;
    \?)
      echo "Invalid option: -$OPTARG"
      echo "See $0 -h for more help"
      exit 1
      ;;
    :)
      echo "Option -$OPTARG requires an argument."
      echo "See $0 -h for more help"
      exit 1
      ;;
  esac
done

LAST_COMMIT=`git log $BRANCH_TO_REVIEW --format="%H" -1 HEAD 2> /dev/null`

if [ "$LAST_COMMIT" = "" ]; then
  echo "Branch '$BRANCH_TO_REVIEW' probably does not exist."
  exit 1
fi

printf "\033[0;36m%-16s\033[0m : %s\n" "Crew server" "$CREW_SERVER"
printf "\033[0;36m%-16s\033[0m : %s\n" "Crew project id" "$CREW_PROJECT_ID"
printf "\033[0;36m%-16s\033[0m : %s\n" "Branch to review" "$BRANCH_TO_REVIEW"
printf "\033[0;36m%-16s\033[0m : %s\n" "Last commit" "$LAST_COMMIT"

echo "Do you want to request a review ? (y/N)"

read REQUEST;
if [ "$REQUEST" = "y" ]; then
  curl -X POST --data "base_branch=master&branch=$BRANCH_TO_REVIEW&commit=$LAST_COMMIT" "$CREW_SERVER/api.php/projects/$CREW_PROJECT_ID/reviews"
  printf "\n"
fi
