<?php

namespace AlibabaCloud\DomainIntl\V20171218;

use AlibabaCloud\ApiResolverTrait;

/**
 * Find the specified Api of the DomainIntl based on the method name as the Api name.
 *
 * @package   AlibabaCloud\DomainIntl\V20171218
 *
 * @method AcknowledgeTaskResult acknowledgeTaskResult(array $options = [])
 * @method BatchFuzzyMatchDomainSensitiveWord batchFuzzyMatchDomainSensitiveWord(array $options = [])
 * @method CheckDomain checkDomain(array $options = [])
 * @method CheckDomainSunriseClaim checkDomainSunriseClaim(array $options = [])
 * @method CheckTransferInFeasibility checkTransferInFeasibility(array $options = [])
 * @method ConfirmTransferInEmail confirmTransferInEmail(array $options = [])
 * @method DeleteEmailVerification deleteEmailVerification(array $options = [])
 * @method DeleteRegistrantProfile deleteRegistrantProfile(array $options = [])
 * @method EmailVerified emailVerified(array $options = [])
 * @method FuzzyMatchDomainSensitiveWord fuzzyMatchDomainSensitiveWord(array $options = [])
 * @method ListEmailVerification listEmailVerification(array $options = [])
 * @method LookupTmchNotice lookupTmchNotice(array $options = [])
 * @method PollTaskResult pollTaskResult(array $options = [])
 * @method QueryChangeLogList queryChangeLogList(array $options = [])
 * @method QueryContactInfo queryContactInfo(array $options = [])
 * @method QueryDSRecord queryDSRecord(array $options = [])
 * @method QueryDnsHost queryDnsHost(array $options = [])
 * @method QueryDomainByInstanceId queryDomainByInstanceId(array $options = [])
 * @method QueryDomainList queryDomainList(array $options = [])
 * @method QueryEnsAssociation queryEnsAssociation(array $options = [])
 * @method QueryLocalEnsAssociation queryLocalEnsAssociation(array $options = [])
 * @method QueryRegistrantProfiles queryRegistrantProfiles(array $options = [])
 * @method QueryTaskDetailHistory queryTaskDetailHistory(array $options = [])
 * @method QueryTaskDetailList queryTaskDetailList(array $options = [])
 * @method QueryTaskInfoHistory queryTaskInfoHistory(array $options = [])
 * @method QueryTaskList queryTaskList(array $options = [])
 * @method QueryTransferInByInstanceId queryTransferInByInstanceId(array $options = [])
 * @method QueryTransferInList queryTransferInList(array $options = [])
 * @method QueryTransferOutInfo queryTransferOutInfo(array $options = [])
 * @method ResendEmailVerification resendEmailVerification(array $options = [])
 * @method SaveBatchTaskForCreatingOrderActivate saveBatchTaskForCreatingOrderActivate(array $options = [])
 * @method SaveBatchTaskForCreatingOrderRedeem saveBatchTaskForCreatingOrderRedeem(array $options = [])
 * @method SaveBatchTaskForCreatingOrderRenew saveBatchTaskForCreatingOrderRenew(array $options = [])
 * @method SaveBatchTaskForCreatingOrderTransfer saveBatchTaskForCreatingOrderTransfer(array $options = [])
 * @method SaveBatchTaskForDomainNameProxyService saveBatchTaskForDomainNameProxyService(array $options = [])
 * @method SaveBatchTaskForModifyingDomainDns saveBatchTaskForModifyingDomainDns(array $options = [])
 * @method SaveBatchTaskForTransferProhibitionLock saveBatchTaskForTransferProhibitionLock(array $options = [])
 * @method SaveBatchTaskForUpdateProhibitionLock saveBatchTaskForUpdateProhibitionLock(array $options = [])
 * @method SaveBatchTaskForUpdatingContactInfo saveBatchTaskForUpdatingContactInfo(array $options = [])
 * @method SaveBatchTaskForUpdatingContactInfoByNewContact saveBatchTaskForUpdatingContactInfoByNewContact(array $options = [])
 * @method SaveRegistrantProfile saveRegistrantProfile(array $options = [])
 * @method SaveSingleTaskForAddingDSRecord saveSingleTaskForAddingDSRecord(array $options = [])
 * @method SaveSingleTaskForApprovingTransferOut saveSingleTaskForApprovingTransferOut(array $options = [])
 * @method SaveSingleTaskForAssociatingEns saveSingleTaskForAssociatingEns(array $options = [])
 * @method SaveSingleTaskForCancelingTransferIn saveSingleTaskForCancelingTransferIn(array $options = [])
 * @method SaveSingleTaskForCancelingTransferOut saveSingleTaskForCancelingTransferOut(array $options = [])
 * @method SaveSingleTaskForCreatingDnsHost saveSingleTaskForCreatingDnsHost(array $options = [])
 * @method SaveSingleTaskForCreatingOrderActivate saveSingleTaskForCreatingOrderActivate(array $options = [])
 * @method SaveSingleTaskForCreatingOrderRedeem saveSingleTaskForCreatingOrderRedeem(array $options = [])
 * @method SaveSingleTaskForCreatingOrderRenew saveSingleTaskForCreatingOrderRenew(array $options = [])
 * @method SaveSingleTaskForCreatingOrderTransfer saveSingleTaskForCreatingOrderTransfer(array $options = [])
 * @method SaveSingleTaskForDeletingDSRecord saveSingleTaskForDeletingDSRecord(array $options = [])
 * @method SaveSingleTaskForDeletingDnsHost saveSingleTaskForDeletingDnsHost(array $options = [])
 * @method SaveSingleTaskForDisassociatingEns saveSingleTaskForDisassociatingEns(array $options = [])
 * @method SaveSingleTaskForDomainNameProxyService saveSingleTaskForDomainNameProxyService(array $options = [])
 * @method SaveSingleTaskForModifyingDSRecord saveSingleTaskForModifyingDSRecord(array $options = [])
 * @method SaveSingleTaskForModifyingDnsHost saveSingleTaskForModifyingDnsHost(array $options = [])
 * @method SaveSingleTaskForQueryingTransferAuthorizationCode saveSingleTaskForQueryingTransferAuthorizationCode(array $options = [])
 * @method SaveSingleTaskForSynchronizingDSRecord saveSingleTaskForSynchronizingDSRecord(array $options = [])
 * @method SaveSingleTaskForSynchronizingDnsHost saveSingleTaskForSynchronizingDnsHost(array $options = [])
 * @method SaveSingleTaskForTransferProhibitionLock saveSingleTaskForTransferProhibitionLock(array $options = [])
 * @method SaveSingleTaskForUpdateProhibitionLock saveSingleTaskForUpdateProhibitionLock(array $options = [])
 * @method SaveSingleTaskForUpdatingContactInfo saveSingleTaskForUpdatingContactInfo(array $options = [])
 * @method SaveTaskForSubmittingDomainDelete saveTaskForSubmittingDomainDelete(array $options = [])
 * @method SubmitEmailVerification submitEmailVerification(array $options = [])
 * @method TransferInCheckMailToken transferInCheckMailToken(array $options = [])
 * @method TransferInReenterTransferAuthorizationCode transferInReenterTransferAuthorizationCode(array $options = [])
 * @method TransferInRefetchWhoisEmail transferInRefetchWhoisEmail(array $options = [])
 * @method TransferInResendMailToken transferInResendMailToken(array $options = [])
 * @method VerifyContactField verifyContactField(array $options = [])
 * @method VerifyEmail verifyEmail(array $options = [])
 */
class DomainIntlApiResolver
{
    use ApiResolverTrait;
}
