# Deletes local branches that have been deleted on the remote

# Make sure you're on main because it should never get pruned
git checkout main &> /dev/null

# Prune branches
git fetch origin --prune &> /dev/null

# List branches that have been removed from origin and write to file
git branch -vv | awk '/: gone]/{print $1}' > /tmp/branchesToPurge

# Open the file for editing
vim /tmp/branchesToPurge

# Print list of branches to be deleted
echo "The following branches will be deleted:"
cat /tmp/branchesToPurge

# Ask if we should proceed
read -p "Are you sure you want to delete these branches (y/n)? " answer
case ${answer:0:1} in
    y|Y )
        echo "Deleting...";
        # Delete branches listed in file
        xargs git branch -D < /tmp/branchesToPurge
        exit;;
    * )
        echo "Aborted";
        exit;;
esac
