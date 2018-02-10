$commit_name = Read-Host -Prompt 'Nom du Commit : '
git add -A
git commit -m "'$commit_name'"
git push origin romain