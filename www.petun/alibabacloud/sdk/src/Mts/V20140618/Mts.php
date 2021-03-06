<?php

namespace AlibabaCloud\Mts\V20140618;

use AlibabaCloud\ApiResolverTrait;

/**
 * Find the specified Api of the Mts based on the method name as the Api name.
 *
 * @package   AlibabaCloud\Mts\V20140618
 *
 * @method static ActivateMediaWorkflow activateMediaWorkflow(array $options = [])
 * @method static AddAsrPipeline addAsrPipeline(array $options = [])
 * @method static AddCategory addCategory(array $options = [])
 * @method static AddCensorPipeline addCensorPipeline(array $options = [])
 * @method static AddCoverPipeline addCoverPipeline(array $options = [])
 * @method static AddKwsPipeline addKwsPipeline(array $options = [])
 * @method static AddMedia addMedia(array $options = [])
 * @method static AddMediaTag addMediaTag(array $options = [])
 * @method static AddMediaWorkflow addMediaWorkflow(array $options = [])
 * @method static AddPipeline addPipeline(array $options = [])
 * @method static AddPornPipeline addPornPipeline(array $options = [])
 * @method static AddTemplate addTemplate(array $options = [])
 * @method static AddTerrorismPipeline addTerrorismPipeline(array $options = [])
 * @method static AddVideoSummaryPipeline addVideoSummaryPipeline(array $options = [])
 * @method static AddWaterMarkTemplate addWaterMarkTemplate(array $options = [])
 * @method static BindInputBucket bindInputBucket(array $options = [])
 * @method static BindOutputBucket bindOutputBucket(array $options = [])
 * @method static CancelJob cancelJob(array $options = [])
 * @method static CategoryTree categoryTree(array $options = [])
 * @method static CheckResource checkResource(array $options = [])
 * @method static CreateKwsDictionary createKwsDictionary(array $options = [])
 * @method static CreateMcuTemplate createMcuTemplate(array $options = [])
 * @method static CreateSession createSession(array $options = [])
 * @method static DeactivateMediaWorkflow deactivateMediaWorkflow(array $options = [])
 * @method static DecryptKey decryptKey(array $options = [])
 * @method static DeleteCategory deleteCategory(array $options = [])
 * @method static DeleteKwsDictionary deleteKwsDictionary(array $options = [])
 * @method static DeleteMcuJob deleteMcuJob(array $options = [])
 * @method static DeleteMcuTemplate deleteMcuTemplate(array $options = [])
 * @method static DeleteMedia deleteMedia(array $options = [])
 * @method static DeleteMediaTag deleteMediaTag(array $options = [])
 * @method static DeleteMediaWorkflow deleteMediaWorkflow(array $options = [])
 * @method static DeletePipeline deletePipeline(array $options = [])
 * @method static DeleteTemplate deleteTemplate(array $options = [])
 * @method static DeleteWaterMarkTemplate deleteWaterMarkTemplate(array $options = [])
 * @method static DescribeMtsUserResourcePackage describeMtsUserResourcePackage(array $options = [])
 * @method static GetLicense getLicense(array $options = [])
 * @method static GetPackage getPackage(array $options = [])
 * @method static ListAllCategory listAllCategory(array $options = [])
 * @method static ListAllMediaBucket listAllMediaBucket(array $options = [])
 * @method static ListAllMediaStorage listAllMediaStorage(array $options = [])
 * @method static ListAsrPipeline listAsrPipeline(array $options = [])
 * @method static ListCensorPipeline listCensorPipeline(array $options = [])
 * @method static ListCoverPipeline listCoverPipeline(array $options = [])
 * @method static ListFpShotJob listFpShotJob(array $options = [])
 * @method static ListJob listJob(array $options = [])
 * @method static ListKwsPipeline listKwsPipeline(array $options = [])
 * @method static ListMedia listMedia(array $options = [])
 * @method static ListMediaCensorJob listMediaCensorJob(array $options = [])
 * @method static ListMediaWorkflowExecutions listMediaWorkflowExecutions(array $options = [])
 * @method static ListPornPipeline listPornPipeline(array $options = [])
 * @method static ListTerrorismPipeline listTerrorismPipeline(array $options = [])
 * @method static ListVideoSummaryPipeline listVideoSummaryPipeline(array $options = [])
 * @method static LogicalDeleteResource logicalDeleteResource(array $options = [])
 * @method static MtsApiResolver mtsApiResolver(array $options = [])
 * @method static PhysicalDeleteResource physicalDeleteResource(array $options = [])
 * @method static PlayInfo playInfo(array $options = [])
 * @method static PlayerAuth playerAuth(array $options = [])
 * @method static QueryAnalysisJobList queryAnalysisJobList(array $options = [])
 * @method static QueryAnnotationJobList queryAnnotationJobList(array $options = [])
 * @method static QueryAsrJobList queryAsrJobList(array $options = [])
 * @method static QueryAsrPipelineList queryAsrPipelineList(array $options = [])
 * @method static QueryAuthConfig queryAuthConfig(array $options = [])
 * @method static QueryCensorJobList queryCensorJobList(array $options = [])
 * @method static QueryCensorPipelineList queryCensorPipelineList(array $options = [])
 * @method static QueryComplexJobList queryComplexJobList(array $options = [])
 * @method static QueryCoverJobList queryCoverJobList(array $options = [])
 * @method static QueryCoverPipelineList queryCoverPipelineList(array $options = [])
 * @method static QueryEditingJobList queryEditingJobList(array $options = [])
 * @method static QueryFacerecogJobList queryFacerecogJobList(array $options = [])
 * @method static QueryFpImportResult queryFpImportResult(array $options = [])
 * @method static QueryFpShotJobList queryFpShotJobList(array $options = [])
 * @method static QueryImageSearchJobList queryImageSearchJobList(array $options = [])
 * @method static QueryJobList queryJobList(array $options = [])
 * @method static QueryKwsDictionary queryKwsDictionary(array $options = [])
 * @method static QueryKwsJobList queryKwsJobList(array $options = [])
 * @method static QueryKwsPipelineList queryKwsPipelineList(array $options = [])
 * @method static QueryMcuJob queryMcuJob(array $options = [])
 * @method static QueryMcuTemplate queryMcuTemplate(array $options = [])
 * @method static QueryMediaCensorJobDetail queryMediaCensorJobDetail(array $options = [])
 * @method static QueryMediaCensorJobList queryMediaCensorJobList(array $options = [])
 * @method static QueryMediaDetailJobList queryMediaDetailJobList(array $options = [])
 * @method static QueryMediaInfoJobList queryMediaInfoJobList(array $options = [])
 * @method static QueryMediaList queryMediaList(array $options = [])
 * @method static QueryMediaListByURL queryMediaListByURL(array $options = [])
 * @method static QueryMediaWorkflowExecutionList queryMediaWorkflowExecutionList(array $options = [])
 * @method static QueryMediaWorkflowList queryMediaWorkflowList(array $options = [])
 * @method static QueryPipelineList queryPipelineList(array $options = [])
 * @method static QueryPornJobList queryPornJobList(array $options = [])
 * @method static QueryPornPipelineList queryPornPipelineList(array $options = [])
 * @method static QuerySnapshotJobList querySnapshotJobList(array $options = [])
 * @method static QuerySubtitleJobList querySubtitleJobList(array $options = [])
 * @method static QueryTagJobList queryTagJobList(array $options = [])
 * @method static QueryTemplateList queryTemplateList(array $options = [])
 * @method static QueryTerrorismJobList queryTerrorismJobList(array $options = [])
 * @method static QueryTerrorismPipelineList queryTerrorismPipelineList(array $options = [])
 * @method static QueryVideoGifJobList queryVideoGifJobList(array $options = [])
 * @method static QueryVideoPoseJobList queryVideoPoseJobList(array $options = [])
 * @method static QueryVideoSplitJobList queryVideoSplitJobList(array $options = [])
 * @method static QueryVideoSummaryJobList queryVideoSummaryJobList(array $options = [])
 * @method static QueryVideoSummaryPipelineList queryVideoSummaryPipelineList(array $options = [])
 * @method static QueryWaterMarkTemplateList queryWaterMarkTemplateList(array $options = [])
 * @method static RefreshCdnDomainConfigsCache refreshCdnDomainConfigsCache(array $options = [])
 * @method static RegisterMediaDetailPerson registerMediaDetailPerson(array $options = [])
 * @method static RegisterMediaDetailScenario registerMediaDetailScenario(array $options = [])
 * @method static ReportAnnotationJobResult reportAnnotationJobResult(array $options = [])
 * @method static ReportAsrJobResult reportAsrJobResult(array $options = [])
 * @method static ReportCensorJobResult reportCensorJobResult(array $options = [])
 * @method static ReportCoverJobResult reportCoverJobResult(array $options = [])
 * @method static ReportFacerecogJobResult reportFacerecogJobResult(array $options = [])
 * @method static ReportFpShotJobResult reportFpShotJobResult(array $options = [])
 * @method static ReportMediaDetailJobResult reportMediaDetailJobResult(array $options = [])
 * @method static ReportPornJobResult reportPornJobResult(array $options = [])
 * @method static ReportTagJobResult reportTagJobResult(array $options = [])
 * @method static ReportTerrorismJobResult reportTerrorismJobResult(array $options = [])
 * @method static ReportVideoSplitJobResult reportVideoSplitJobResult(array $options = [])
 * @method static SearchMedia searchMedia(array $options = [])
 * @method static SearchMediaWorkflow searchMediaWorkflow(array $options = [])
 * @method static SearchPipeline searchPipeline(array $options = [])
 * @method static SearchTemplate searchTemplate(array $options = [])
 * @method static SearchWaterMarkTemplate searchWaterMarkTemplate(array $options = [])
 * @method static SetAuthConfig setAuthConfig(array $options = [])
 * @method static SubmitAnalysisJob submitAnalysisJob(array $options = [])
 * @method static SubmitAnnotationJob submitAnnotationJob(array $options = [])
 * @method static SubmitAsrJob submitAsrJob(array $options = [])
 * @method static SubmitComplexJob submitComplexJob(array $options = [])
 * @method static SubmitCoverJob submitCoverJob(array $options = [])
 * @method static SubmitEditingJobs submitEditingJobs(array $options = [])
 * @method static SubmitFacerecogJob submitFacerecogJob(array $options = [])
 * @method static SubmitFpShotJob submitFpShotJob(array $options = [])
 * @method static SubmitImageQuality submitImageQuality(array $options = [])
 * @method static SubmitImageQualityJob submitImageQualityJob(array $options = [])
 * @method static SubmitImageSearchJob submitImageSearchJob(array $options = [])
 * @method static SubmitJobs submitJobs(array $options = [])
 * @method static SubmitKwsJob submitKwsJob(array $options = [])
 * @method static SubmitMcuJob submitMcuJob(array $options = [])
 * @method static SubmitMediaCensorJob submitMediaCensorJob(array $options = [])
 * @method static SubmitMediaDetailJob submitMediaDetailJob(array $options = [])
 * @method static SubmitMediaInfoJob submitMediaInfoJob(array $options = [])
 * @method static SubmitPornJob submitPornJob(array $options = [])
 * @method static SubmitSnapshotJob submitSnapshotJob(array $options = [])
 * @method static SubmitSubtitleJob submitSubtitleJob(array $options = [])
 * @method static SubmitTagJob submitTagJob(array $options = [])
 * @method static SubmitTerrorismJob submitTerrorismJob(array $options = [])
 * @method static SubmitVideoGifJob submitVideoGifJob(array $options = [])
 * @method static SubmitVideoPoseJob submitVideoPoseJob(array $options = [])
 * @method static SubmitVideoSplitJob submitVideoSplitJob(array $options = [])
 * @method static SubmitVideoSummaryJob submitVideoSummaryJob(array $options = [])
 * @method static UnbindInputBucket unbindInputBucket(array $options = [])
 * @method static UnbindOutputBucket unbindOutputBucket(array $options = [])
 * @method static UnindInputBucket unindInputBucket(array $options = [])
 * @method static UpdateAsrPipeline updateAsrPipeline(array $options = [])
 * @method static UpdateCategoryName updateCategoryName(array $options = [])
 * @method static UpdateCensorPipeline updateCensorPipeline(array $options = [])
 * @method static UpdateCoverPipeline updateCoverPipeline(array $options = [])
 * @method static UpdateKwsDictionary updateKwsDictionary(array $options = [])
 * @method static UpdateKwsPipeline updateKwsPipeline(array $options = [])
 * @method static UpdateMcuTemplate updateMcuTemplate(array $options = [])
 * @method static UpdateMedia updateMedia(array $options = [])
 * @method static UpdateMediaCategory updateMediaCategory(array $options = [])
 * @method static UpdateMediaCover updateMediaCover(array $options = [])
 * @method static UpdateMediaPublishState updateMediaPublishState(array $options = [])
 * @method static UpdateMediaWorkflow updateMediaWorkflow(array $options = [])
 * @method static UpdateMediaWorkflowTriggerMode updateMediaWorkflowTriggerMode(array $options = [])
 * @method static UpdatePipeline updatePipeline(array $options = [])
 * @method static UpdatePornPipeline updatePornPipeline(array $options = [])
 * @method static UpdateTemplate updateTemplate(array $options = [])
 * @method static UpdateTerrorismPipeline updateTerrorismPipeline(array $options = [])
 * @method static UpdateVideoSummaryPipeline updateVideoSummaryPipeline(array $options = [])
 * @method static UpdateWaterMarkTemplate updateWaterMarkTemplate(array $options = [])
 */
class Mts
{
    use ApiResolverTrait;
}
