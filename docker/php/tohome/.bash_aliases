#dasbit's profile

ESC_SEQ="\x1b["
COL_RESET=$ESC_SEQ"39;49;00m"
COL_RED=$ESC_SEQ"31;01m"
COL_GREEN=$ESC_SEQ"32;01m"
COL_YELLOW=$ESC_SEQ"33;01m"
COL_BLUE=$ESC_SEQ"34;01m"
COL_MAGENTA=$ESC_SEQ"35;01m"
COL_CYAN=$ESC_SEQ"36;01m"

# Git show branch
parse_git_branch() {
     git branch 2> /dev/null | sed -e '/^[^*]/d' -e 's/* \(.*\)/ (\1)/'
}
export PS1="\u@\h \[\033[32m\]\w\[\033[33m\]\$(parse_git_branch)\[\033[00m\] $ "
# Create a new directory and enter it
function mkd() {
    mkdir -p "$@" && cd "$@"
}

function md() {
    mkdir -p "$@" && cd "$@"
}

function xtree {
    find ${1:-.} -print | sed -e 's;[^/]*/;|____;g;s;____|; |;g'
}


#base aliases
alias ll='LC_COLLATE=C ls -lahF '
alias l='ls'
# Commonly Used Aliases
alias ..="cd .."
alias c="clear"
alias cla="clear && ls -l"
alias cll="clear && ls -la"
alias cls="clear && ls"
alias ea="vi ~/aliases"
alias g="gulp"
alias home="cd ~"

# Git aliases
alias gs="git status"
alias gst='git status'
alias gad='git add'
alias gaa="git add ."
alias gc='git commit'
alias gco='git checkout'
alias gl='git pull'
alias gpom="git pull origin master"
alias gp='git push'
alias gd='git diff | mate'
alias gb='git branch'
alias gba='git branch -a'
alias gbd='git branch -d'
alias gd="git --no-pager diff"
alias git-revert="git reset --hard && git clean -df"
alias whoops="git reset --hard && git clean -df"

#PHP and Laravel
alias art="php artisan"
alias artisan="php artisan"
alias cdump="composer dump-autoload -o"
alias composer:dump="composer dump-autoload -o"
alias db:reset="php artisan migrate:reset && php artisan migrate --seed"
alias migrate="php artisan migrate"
alias seed="php artisan:seed"
alias phpunit="./vendor/bin/phpunit"
