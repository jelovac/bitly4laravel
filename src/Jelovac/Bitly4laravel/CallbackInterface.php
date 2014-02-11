<?php namespace Jelovac\Bitly4laravel;

interface CallbackInterface {
    
    // Data APIs
    public function highvalue($limit);
    public function search($query, $fields, $offset, $limit, $domain,  $fullDomain, $cities, $lang);
    public function realtimeBurstingPhrases();
    public function realtimeHotPhrases();
    public function realtimeClickrate($phrase);
    public function linkInfo($link);
    public function linkContent($link, $contentType);
    public function linkCategory($link);
    public function linkSocial($link);
    public function linkLocation($link);
    public function linkLanguage($link);
    
    // Links
    public function expand($shortURLOrHash);
    public function info($hash, $shortURL, $expandUser);
    public function linkLookup($url);
    public function shorten($longURL, $domain = null);
    public function userLinkEdit($link, $edit, $title = null, $note = null, $private = null, $userTimeStamp = null, $archived = null);
    public function userLinkLookup($url);
    public function userLinkSave($longURL, $title = null, $note = null, $private = null, $userTimeStamp = null);
    public function userSaveCustomDomainKeyword($keywordLink, $targetLink);
    
    // Link metrics
    public function linkClicks($link, $unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp);
    public function linkCountries($link, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function linkEncoders($link, $myNetwork = null, $subaccounts = null, $limit = null, $expandUser = null);
    public function linkEncodersByCount($link, $myNetwork = null, $subaccounts = null, $limit = null, $expandUser = null);
    public function linkEncodersCount($link);
    public function linkReferrers($link, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function linkReferrersByDomain($link, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function linkReferringDomains($link, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function linkShares($link, $unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp);
    
    // User info / history
    public function oAuthApp($clientId);
    public function userInfo($login = null, $fullName = null);
    public function userLinkHistory($link = null, $query = null, $offset = null, $limit = null, $createdBefore = null, $createdAfter = null, $modifiedAfter = null, $expandClientId = null, $archived = null, $private = null, $user = null, $exactDomain = null, $rootDomain = null);
    public function userNetworkHistory($offset = null, $expandClientId = null, $limit = null, $expandUser = null);
    public function userTrackingDomainList();
    
    // User metrics
    public function userClicks($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp);
    public function userCountries($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp);
    public function userPopularEarnedByClicks($domain, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function userPopularEarnedByShortens($domain, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function userPopularLinks($unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function userPopularOwnedByClicks($domain, $subaccount, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function userPopularOwnedByShortens($domain, $subaccount, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function userReferrers($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp);
    public function userReferringDomains($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp);
    public function userShareCounts($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp);
    public function userShareCountsByShareType($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp);
    public function userShortenCounts($unit, $units, $timezone, $rollup, $limit, $unitReferenceTimeStamp);
    
    // Organization Metrics
    public function organizationBrandMessages($domain, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function organizationIntersectingLinks($domain, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function organizationLeaderboard($domain, $orderBy, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    public function organizationMissedOpportunities($domain, $unit, $units, $timezone, $limit, $unitReferenceTimeStamp);
    
    // Bundles
    public function bundleArchive($budleLink);
    public function bundleBundlesByUser($user, $expandUser = null);
    public function bundleClone($budleLink);
    public function bundleCollaboratorAdd($budleLink, $collaborator);
    public function bundleCollaboratorRemove($budleLink, $collaborator);
    public function bundleContents($bundleLink, $expandUser = null);
    public function bundleCreate($private = null, $title = null, $description = null);
    public function bundleEdit($bundleLink, $edit = null, $title = null, $description = null, $private = null, $preview = null, $ogImage = null);
    public function bundleLinkAdd($bundleLink, $link, $title = null);
    public function bundleLinkCommentAdd($bundleLink, $link, $comment);
    public function bundleLinkCommentEdit($bundleLink, $link, $commentId, $comment);
    public function bundleLinkCommentRemove($bundleLink, $link, $commentId);
    public function bundleLinkEdit($bundleLink, $link, $edit, $title = null, $preview = null);
    public function bundleLinkRemove($bundleLink, $link);
    public function bundleLinkReorder($bundleLink, $link, $displayOrder);
    public function bundlePendingCollaboratorRemove($bundleLink, $collaborator);
    public function bundleReorder($bundleLink, $link);
    public function bundleViewCount($bundleLink);
    public function userBundleHistory($expandUser = null);
    
}