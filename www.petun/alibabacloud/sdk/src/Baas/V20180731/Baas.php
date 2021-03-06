<?php

namespace AlibabaCloud\Baas\V20180731;

use AlibabaCloud\ApiResolverTrait;

/**
 * Find the specified Api of the Baas based on the method name as the Api name.
 *
 * @package   AlibabaCloud\Baas\V20180731
 *
 * @method static AcceptInvitation acceptInvitation(array $options = [])
 * @method static ApplyBlockchain applyBlockchain(array $options = [])
 * @method static BaasApiResolver baasApiResolver(array $options = [])
 * @method static CheckConsortiumDomain checkConsortiumDomain(array $options = [])
 * @method static CheckOrganizationDomain checkOrganizationDomain(array $options = [])
 * @method static ConfirmConsortiumMember confirmConsortiumMember(array $options = [])
 * @method static CreateBlockchainApplication createBlockchainApplication(array $options = [])
 * @method static CreateBlockchainApply createBlockchainApply(array $options = [])
 * @method static CreateChaincode createChaincode(array $options = [])
 * @method static CreateChannel createChannel(array $options = [])
 * @method static CreateChannelMember createChannelMember(array $options = [])
 * @method static CreateConsortium createConsortium(array $options = [])
 * @method static CreateConsortiumMember createConsortiumMember(array $options = [])
 * @method static CreateEcosphere createEcosphere(array $options = [])
 * @method static CreateOrganization createOrganization(array $options = [])
 * @method static DeleteChaincode deleteChaincode(array $options = [])
 * @method static DescribeApplies describeApplies(array $options = [])
 * @method static DescribeBcSchema describeBcSchema(array $options = [])
 * @method static DescribeBlock describeBlock(array $options = [])
 * @method static DescribeBlockchainCreateTask describeBlockchainCreateTask(array $options = [])
 * @method static DescribeBlockchainInfo describeBlockchainInfo(array $options = [])
 * @method static DescribeBlockchainSchema describeBlockchainSchema(array $options = [])
 * @method static DescribeCandidateOrganizations describeCandidateOrganizations(array $options = [])
 * @method static DescribeChaincodeCollectionConfig describeChaincodeCollectionConfig(array $options = [])
 * @method static DescribeChaincodeUploadPolicy describeChaincodeUploadPolicy(array $options = [])
 * @method static DescribeChannelMembers describeChannelMembers(array $options = [])
 * @method static DescribeConsortiumAdminStatus describeConsortiumAdminStatus(array $options = [])
 * @method static DescribeConsortiumChaincodes describeConsortiumChaincodes(array $options = [])
 * @method static DescribeConsortiumChannels describeConsortiumChannels(array $options = [])
 * @method static DescribeConsortiumConfig describeConsortiumConfig(array $options = [])
 * @method static DescribeConsortiumDeletable describeConsortiumDeletable(array $options = [])
 * @method static DescribeConsortiumMemberApproval describeConsortiumMemberApproval(array $options = [])
 * @method static DescribeConsortiumMembers describeConsortiumMembers(array $options = [])
 * @method static DescribeConsortiumOrderers describeConsortiumOrderers(array $options = [])
 * @method static DescribeConsortiumSpecs describeConsortiumSpecs(array $options = [])
 * @method static DescribeConsortiums describeConsortiums(array $options = [])
 * @method static DescribeEcosphereSpecs describeEcosphereSpecs(array $options = [])
 * @method static DescribeEthereumDeletable describeEthereumDeletable(array $options = [])
 * @method static DescribeEthereumNodeConfiguration describeEthereumNodeConfiguration(array $options = [])
 * @method static DescribeExplorer describeExplorer(array $options = [])
 * @method static DescribeInvitationCode describeInvitationCode(array $options = [])
 * @method static DescribeInvitationList describeInvitationList(array $options = [])
 * @method static DescribeInviter describeInviter(array $options = [])
 * @method static DescribeMetric describeMetric(array $options = [])
 * @method static DescribeMyBlockchains describeMyBlockchains(array $options = [])
 * @method static DescribeMySuccessApplies describeMySuccessApplies(array $options = [])
 * @method static DescribeMySuccessfulApplication describeMySuccessfulApplication(array $options = [])
 * @method static DescribeOrdererLogs describeOrdererLogs(array $options = [])
 * @method static DescribeOrganization describeOrganization(array $options = [])
 * @method static DescribeOrganizationChaincodes describeOrganizationChaincodes(array $options = [])
 * @method static DescribeOrganizationChannels describeOrganizationChannels(array $options = [])
 * @method static DescribeOrganizationDeletable describeOrganizationDeletable(array $options = [])
 * @method static DescribeOrganizationMembers describeOrganizationMembers(array $options = [])
 * @method static DescribeOrganizationPeers describeOrganizationPeers(array $options = [])
 * @method static DescribeOrganizationSpecs describeOrganizationSpecs(array $options = [])
 * @method static DescribeOrganizationUserCerts describeOrganizationUserCerts(array $options = [])
 * @method static DescribeOrganizationUsers describeOrganizationUsers(array $options = [])
 * @method static DescribeOrganizations describeOrganizations(array $options = [])
 * @method static DescribeOrgnaizationChaincodes describeOrgnaizationChaincodes(array $options = [])
 * @method static DescribeOssProperties describeOssProperties(array $options = [])
 * @method static DescribePeerLogs describePeerLogs(array $options = [])
 * @method static DescribeRegions describeRegions(array $options = [])
 * @method static DescribeResourceType describeResourceType(array $options = [])
 * @method static DescribeRootDomain describeRootDomain(array $options = [])
 * @method static DescribeSchemaDetail describeSchemaDetail(array $options = [])
 * @method static DescribeTasks describeTasks(array $options = [])
 * @method static DescribeTemplates describeTemplates(array $options = [])
 * @method static DescribeTransaction describeTransaction(array $options = [])
 * @method static DestroyConsortium destroyConsortium(array $options = [])
 * @method static DestroyEthereum destroyEthereum(array $options = [])
 * @method static DestroyOrganization destroyOrganization(array $options = [])
 * @method static DownloadAll downloadAll(array $options = [])
 * @method static DownloadBizview downloadBizview(array $options = [])
 * @method static DownloadOrganizationSDK downloadOrganizationSDK(array $options = [])
 * @method static DownloadSDK2 downloadSDK2(array $options = [])
 * @method static DownloadSdk downloadSdk(array $options = [])
 * @method static DownloadSignedData downloadSignedData(array $options = [])
 * @method static GetApplies getApplies(array $options = [])
 * @method static GetBcSchema getBcSchema(array $options = [])
 * @method static GetBlockchainCreateTask getBlockchainCreateTask(array $options = [])
 * @method static GetBlockchainInfo getBlockchainInfo(array $options = [])
 * @method static GetMyBlockchains getMyBlockchains(array $options = [])
 * @method static GetMySuccessApplies getMySuccessApplies(array $options = [])
 * @method static GetOssProperties getOssProperties(array $options = [])
 * @method static GetTemplates getTemplates(array $options = [])
 * @method static InstallChaincode installChaincode(array $options = [])
 * @method static InstantiateChaincode instantiateChaincode(array $options = [])
 * @method static InviteUser inviteUser(array $options = [])
 * @method static JoinChannel joinChannel(array $options = [])
 * @method static OperateUser operateUser(array $options = [])
 * @method static QueryBlock queryBlock(array $options = [])
 * @method static QueryConsortiumDeletable queryConsortiumDeletable(array $options = [])
 * @method static QueryEthereumDeletable queryEthereumDeletable(array $options = [])
 * @method static QueryMetric queryMetric(array $options = [])
 * @method static QueryOrganizationDeletable queryOrganizationDeletable(array $options = [])
 * @method static QueryTransaction queryTransaction(array $options = [])
 * @method static RejectUser rejectUser(array $options = [])
 * @method static ResetCertificate resetCertificate(array $options = [])
 * @method static ResetOrganizationUserPassword resetOrganizationUserPassword(array $options = [])
 * @method static ResetUser resetUser(array $options = [])
 * @method static SchemaDetail schemaDetail(array $options = [])
 * @method static SynchronizeChaincode synchronizeChaincode(array $options = [])
 * @method static UpdateSchema updateSchema(array $options = [])
 * @method static UpgradeChaincode upgradeChaincode(array $options = [])
 */
class Baas
{
    use ApiResolverTrait;
}
